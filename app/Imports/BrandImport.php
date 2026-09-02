<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Brand;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class BrandImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ++$this->rowCount;
            try {
                $name = $row[0];
                $shortCode = $row[1];

                $brand = Brand::updateOrCreate([
                    'name' => $name,
                ],[
                    'short_code' => $shortCode,
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
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'Name',
            '1' => 'Short Code',
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
