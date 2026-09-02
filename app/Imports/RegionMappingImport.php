<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\LatestWD;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Log, DB;

class RegionMappingImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ++$this->rowCount;
            try {
                $wdCode = $row[0];
                $town = $row[1];
                $region = $row[2];

                $wdData = LatestWD::where('code', $wdCode)->first();

                if (!$wdData) {
                    Log::warning('WD data not found for code: ' . $wdCode);
                }
                else{
                    LatestWD::where('code', $wdCode)->update([
                        'region' => $region,
                        'town' => $town
                    ]);
                }

            } catch (ValidationException $e) {
                $this->failed($e);
            }
        }
    }
    
    public function startRow(): int
    {
        return 2;
    }

    public function rules():array   
    {
        return [
            '*.0' => ['required'],
            '*.1' => ['required'],
            '*.1' => ['required'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'WD Code',
            '1' => 'Town',
            '2' => 'Region',
        ];
    }

    public function onError(Throwable $error)
    {
        \Log::error('Import failed (onError): '.$exception->getMessage());
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
