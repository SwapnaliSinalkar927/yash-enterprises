<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Code;
use App\Models\Brand;
use App\Models\WD;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents, WithHeadingRow};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Throwable;
use DB;
use Log;

class CodeImport implements ToCollection, WithValidation, WithChunkReading, ShouldQueue, WithEvents
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        $header = $rows->first(); // First row is header
        $rows = $rows->slice(1);  // Skip header row
        $latestBatch = Code::max('batch') ?? 0;
        $currentBatch = $latestBatch + 1;

        foreach ($rows as $rowIndex => $row) {
            DB::beginTransaction();
            try {
                ++$this->rowCount;

                $wdCode     = trim($row[0]);
                $firmName   = $row[1];
                $tb         = $row[2];
                $location   = $row[3];
                $brandShort = strtoupper(trim($row[4]));

                $tbWords = explode(' ', trim($tb));
                $tbShort = strtoupper(implode('', array_map(fn($word) => substr($word, 0, 1), $tbWords)));

                $wd = WD::firstOrCreate(
                    ['code' => $wdCode],
                    ['firm_name' => $firmName, 'tb' => $tb, 'location' => $location]
                );

                $brand = Brand::where('short_code', $brandShort)->first();
                if (!$brand) {
                    throw new \Exception("Brand not found for short code: {$brandShort}");
                }

                // Process dynamic value columns (1m Count, 2m Count, etc.)
                for ($col = 5; $col < count($row); $col++) {
                    $headerTitle = trim($header[$col]);
                    if (preg_match('/^(\d+)m\s+count$/i', $headerTitle, $match)) {
                        $value = (int) $match[1];
                        $count = (int) ($row[$col] ?? 0);

                        if ($count > 0) {
                            $prefix = "{$tbShort}{$wdCode}{$brandShort}{$value}";
                            $this->generateCodes($prefix, $count, $value, $wd->id, $brand->id, $currentBatch);
                        }
                    }
                }
                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                $this->failed($e);
                Log::error("Import failed for row $rowIndex: " . $e->getMessage());
            }
        }
    }

    protected function generateCodes($prefix, $count, $value, $wdId, $brandId, $currentBatch)
    {
        $generated = [];
        $maxAttempts = $count * 2;

        while (count($generated) < $count && $maxAttempts--) {
            $suffix = strtoupper(Str::random(4));
            $codeStr = $prefix . $suffix;

            if (!in_array($codeStr, $generated) && !Code::where('code', $codeStr)->exists()) {
                $generated[] = $codeStr;
            }
        }

        $chunkSize = 500;
        $now = now();

        collect($generated)
            ->chunk($chunkSize)
            ->each(function ($chunk) use ($value, $wdId, $brandId, $currentBatch, $now) {
                $data = [];

                foreach ($chunk as $codeStr) {
                    $data[] = [
                        'id' => (string) Str::uuid(),
                        'code' => $codeStr,
                        'value' => $value,
                        'wd_id' => $wdId,
                        'brand_id' => $brandId,
                        'batch' => $currentBatch,
                        'status' => 1,
                        'is_used' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                Code::insert($data);
            });
    }


    public function startRow(): int
    {
        return 2; // skip header row
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required'], // wd_code
            '*.1' => ['sometimes'], // firm_name
            '*.2' => ['required'], // tb
            '*.3' => ['required'], // brand
            '*.4' => ['sometimes'], // location
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'WD Code',
            '1' => 'Firm Name',
            '2' => 'TB',
            '3' => 'Brand',
            '4' => 'Location',
        ];
    }

    public function onError(Throwable $error)
    {
        Log::error('Import error: ' . $error->getMessage());
    }

    public function failed($e)
    {
        Log::error('Import failed: ' . $e->getMessage());
        if ($e instanceof ValidationException) {
            // Notify if needed
        }
    }

    public function registerEvents(): array
    {
        $user = auth()->user();
        return [
            ImportFailed::class => function (ImportFailed $event) use ($user) {
                Log::error('Import event failed: ' . $event->getException()->getMessage());
                // Optionally notify user
            },
        ];
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function chunkSize(): int
    {
        return 200;
    }
}
