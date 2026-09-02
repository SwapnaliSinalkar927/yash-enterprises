<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Wholesaler;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class WholesalerImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ++$this->rowCount;
            try {
                $fullName = $row[0];
                $mobileNumber = $row[1];
                $pincode = $row[2] ?? NULL;

                $wholesaler = Wholesaler::updateOrCreate([
                    'mobile_number' => $mobileNumber,
                ],[
                    'full_name' => $fullName,
                    'pincode' => $pincode,
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
            '*.2' => ['sometimes'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'Full Name',
            '1' => 'Mobile Number',
            '2' => 'Pincode',
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
