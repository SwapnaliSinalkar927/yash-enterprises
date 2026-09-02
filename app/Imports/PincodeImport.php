<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\LatestCode;
use App\Models\Pincode;
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

class PincodeImport implements ToCollection, WithValidation, WithChunkReading, ShouldQueue, WithEvents
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        $header = $rows->first(); 
        $rows = $rows->slice(1); // skip header row

        foreach ($rows as $rowIndex => $row) {
            if ($row->filter()->isEmpty()) continue; // skip empty rows

            DB::beginTransaction();
            try {
                ++$this->rowCount;

               // Map columns
                $state     = trim($row[0] ?? '');
                $region    = trim($row[1] ?? '');
                $division  = trim($row[2] ?? '');
                $area      = trim($row[3] ?? '');
                $code      = trim($row[4] ?? '');
                $latitude  = trim($row[5] ?? '');
                $longitude = trim($row[6] ?? '');

                    Pincode::create([
                        'id' => (string) Str::uuid(),
                        'state' => $state,
                        'region' => $region,
                        'division' => $division,
                        'area' => $area,
                        'code' => $code,
                        'lat' => $latitude,
                        'long' => $longitude,
                    ]);
               
                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error("Import failed for row $rowIndex: " . $e->getMessage());
            }
        }
    }

    public function startRow(): int
    {
        return 2; // skip header
    }

    public function rules(): array
    {
        return [
            '*.0' => ['sometimes'], // WD Code
            '*.1' => ['sometimes'], // Firm Name
            '*.2' => ['sometimes'], // TB
            '*.3' => ['sometimes'], // Brand
            '*.4' => ['required'], // Location
            '*.5' => ['sometimes'], // Location
            '*.6' => ['sometimes'], // Location
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'State',
            '1' => 'Region',
            '2' => 'Division',
            '3' => 'Area',
            '4' => 'Code',
            '5' => 'Latitude',
            '6' => 'Longitude',
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
