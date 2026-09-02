<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\WD;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class WDImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ++$this->rowCount;
            try {
                $code = $row[0];
                $firmName = $row[1];
                $tb = $row[2];
                $location = $row[3];

                $wd = WD::updateOrCreate([
                    'code' => $code,
                ],[
                    'firm_name' => $firmName,
                    'tb' => $tb,
                    'location' => $location,
                    'status' => 1,
                ]);

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
            '*.2' => ['required'],
            '*.3' => ['required'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'WD Code',
            '1' => 'Firm Name',
            '2' => 'TB',
            '3' => 'location',
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
