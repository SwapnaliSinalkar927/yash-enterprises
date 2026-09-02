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

class LatestCodeImport implements
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

                $wdCode     = trim($row[0] ?? '');
                $section    = trim($row[1] ?? '');
                $town       = trim($row[2] ?? '');
                $district   = trim($row[3] ?? '');
                $brandShort = strtoupper(trim($row[4] ?? ''));
                $value      = trim($row[5] ?? '');

                // Create or get WD
                $wd = LatestWD::firstOrCreate(
                    ['code' => $wdCode],
                    [
                        'section_name' => $section,
                        'town'         => $town,
                        'district'     => $district,
                    ]
                );

                $brand = Brand::whereRaw('UPPER(short_code) = ?', [$brandShort])->first();

                if (!$brand) {
                    throw new \Exception("Brand not found for short code: {$brandShort}");
                }

                $denominations = [
                    [
                        'denomination' => trim($row[6] ?? ''),
                        'count'        => (int) ($row[7] ?? 0),
                    ],
                    [
                        'denomination' => trim($row[8] ?? ''),
                        'count'        => (int) ($row[9] ?? 0),
                    ],
                    [
                        'denomination' => trim($row[10] ?? ''),
                        'count'        => (int) ($row[11] ?? 0),
                    ],
                    [
                        'denomination' => trim($row[12] ?? ''),
                        'count'        => (int) ($row[13] ?? 0),
                    ],
                ];

                $now = now();
                $data = [];
                $generatedCodes = [];

                foreach ($denominations as $item) {

                    if (empty($item['denomination']) || $item['count'] <= 0) {
                        continue;
                    }

                    for ($i = 0; $i < $item['count']; $i++) {

                        do {
                            $randomPart = strtoupper(Str::random(4));
                            $codeStr = $wdCode . $item['denomination'] . $randomPart;
                        } while (isset($generatedCodes[$codeStr]));

                        $generatedCodes[$codeStr] = true;

                       $data[] = [
                            'id'            => (string) Str::uuid(),
                            'code'          => $codeStr,
                            'denomination'  => $item['denomination'],
                            'value'         => $value,
                            'latest_wd_id'  => $wd->id,
                            'brand_id'      => $brand->id,
                            'batch'         => $currentBatch,
                            'status'        => 1,
                            'is_used'       => 0,
                            'created_at'    => $now,
                            'updated_at'    => $now,
                        ];
                    }
                }

                foreach (array_chunk($data, 5000) as $chunk) {
                    LatestCode::insert($chunk);
                }

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error("Import failed for row $rowIndex: " . $e->getMessage());
            }
        }
    }

    public function startRow(): int
    {
        return 2; // Skip header
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required'], // WD Code
            '*.1' => ['required'], // Firm Name
            '*.2' => ['required'], // TB
            '*.3' => ['required'], // Brand
            '*.4' => ['required'], // Location
            '*.5' => ['required'], // Location
            '*.6' => ['required'], // Location
            '*.7' => ['required'], // Location
            '*.8' => ['required'], // Brand
            '*.9' => ['required'], // Location
            '*.10' => ['required'], // Location
            '*.11' => ['required'], // Location
            '*.12' => ['required'], // Location
            '*.13' => ['required'], // Location
        ];
    }

    public function customValidationAttributes()
    {
       return [
            '0'  => 'WD Code',
            '1'  => 'Section',
            '2'  => 'Town',
            '3'  => 'District',
            '4'  => 'Brand',
            '5'  => 'Value',
            '6'  => 'Denomination 1',
            '7'  => 'Count 1',
            '8'  => 'Denomination 2',
            '9'  => 'Count 2',
            '10' => 'Denomination 3',
            '11' => 'Count 3',
            '12' => 'Denomination 4',
            '13' => 'Count 4',
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
