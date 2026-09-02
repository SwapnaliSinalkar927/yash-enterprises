<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\LatestCode;
use App\Models\Brand;
use App\Models\LatestWD;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    Importable,
    WithStartRow,
    WithValidation,
    WithChunkReading,
    WithEvents
};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Throwable;
use DB;
use Log;
use Maatwebsite\Excel\Events\ImportFailed;

class LatestCodeImport1 implements
    ToCollection,
    WithValidation,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        $header = $rows->first();
        $rows = $rows->slice(1); // Skip header row

        $latestBatch = LatestCode::max('batch') ?? 0;
        $currentBatch = $latestBatch + 1;

        foreach ($rows as $rowIndex => $row) {
            if ($row->filter()->isEmpty()) {
                continue; // Skip empty rows
            }

            DB::beginTransaction();

            try {
                ++$this->rowCount;

                // Map columns
                $wdCode     = trim($row[0] ?? '');
                $firmName   = trim($row[1] ?? '');
                $tb         = trim($row[2] ?? '');
                $brandShort = strtoupper(trim($row[3] ?? ''));
                $location   = trim($row[4] ?? '');

                // Create or get WD
                $wd = LatestWD::firstOrCreate(
                    ['code' => $wdCode],
                    [
                        'firm_name' => $firmName,
                        'section_name' => $location,
                        
                        // 'tb'        => $tb,
                        // 'location'  => null,
                        // 'town' => $location,
                    ]
                );

                // Get brand
                $brand = Brand::whereRaw('UPPER(short_code) = ?', [$brandShort])->first();

                if (!$brand) {
                    throw new \Exception("Brand not found for short code: {$brandShort}");
                }

                // Process dynamic meter columns
                for ($col = 5; $col < count($row); $col++) {
                    $headerTitle = trim($header[$col] ?? '');

                    if (preg_match('/^([\d\.]+)m\s+count$/i', $headerTitle, $match)) {
                        $value = (float)$match[1];
                        $count = (int)($row[$col] ?? 0);

                        if ($count > 0) {
                            $prefix = $wdCode;

                            $this->generateCodes(
                                $prefix,
                                $count,
                                $value,
                                $wd->id,
                                $brand->id,
                                $currentBatch
                            );
                        }
                    }
                }

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error("Import failed for row $rowIndex: " . $e->getMessage());
            }
        }
    }

    protected function generateCodes($prefix, $count, $value, $wdId, $brandId, $currentBatch)
    {
        $generated = [];
        $maxAttempts = $count * 5;

        while (count($generated) < $count && $maxAttempts--) {

            // Fixed lengths
            $suffixLength1 = 3;
            $suffixLength2 = 3;

            // First character (letter only)
            $firstChar = chr(rand(65, 90));

            // Generate random alpha-numeric sequences
            $charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

            $remaining1 = '';
            for ($i = 0; $i < $suffixLength1 - 1; $i++) {
                $remaining1 .= $charSet[rand(0, strlen($charSet) - 1)];
            }

            $remaining2 = '';
            for ($i = 0; $i < $suffixLength2 - 1; $i++) {
                $remaining2 .= $charSet[rand(0, strlen($charSet) - 1)];
            }

            // Construct code based on value
            if ($value == 0.6) {
                $codeStr = $prefix . $firstChar . $remaining1 . '6' . $firstChar . $remaining2;
            } elseif ($value == 2) {
                $codeStr = $prefix . $firstChar . $remaining1 . '20' . $firstChar . $remaining2;
            } elseif ($value == 5) {
                $codeStr = $prefix . $firstChar . $remaining1 . '50' . $firstChar . $remaining2;
            } else {
                continue; // unsupported value
            }

            // Ensure uniqueness
            if (!in_array($codeStr, $generated)
                && !LatestCode::where('code', $codeStr)->exists()
            ) {
                $generated[] = $codeStr;
            }
        }

        // Bulk insert
        $now = now();
        $chunkSize = 500;

        collect($generated)->chunk($chunkSize)->each(function ($chunk) use (
            $value,
            $wdId,
            $brandId,
            $currentBatch,
            $now
        ) {
            $data = [];

            foreach ($chunk as $codeStr) {
                $data[] = [
                    'id'            => (string)Str::uuid(),
                    'code'          => $codeStr,
                    'value'         => $value,
                    'latest_wd_id'  => $wdId,
                    'brand_id'      => $brandId,
                    'batch'         => $currentBatch,
                    'status'        => 1,
                    'is_used'       => 0,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }

            LatestCode::insert($data);
        });
    }

    public function startRow(): int
    {
        return 2; // Skip header
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required'], // WD Code
            '*.1' => ['nullable'], // Firm Name
            '*.2' => ['nullable'], // TB
            '*.3' => ['required'], // Brand
            '*.4' => ['nullable'], // Location
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

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                Log::error('Import event failed: ' . $event->getException()->getMessage());
            },
        ];
    }

    public function chunkSize(): int
    {
        return 200;
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
