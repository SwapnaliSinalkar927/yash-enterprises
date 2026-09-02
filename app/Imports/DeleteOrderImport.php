<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\{Order,Code,WD,Brand};
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class DeleteOrderImport implements ToCollection, WithStartRow, WithValidation
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
                 $wd_code = $row[4];
                 $brand_name = $row[8];
                 $value = $row[1];
                $batch = $row[3];
                
                 $wd = WD::firstOrCreate(
                    ['code' => $wd_code]
                );
                 $brand = Brand::where('short_code','FM')->first();

                  $now = now();

                 $codeCreate = Code::create([
                    'code' => $code,
                    'value' => $value,
                    'wd_id' => $wd->id,
                    'brand_id' => $brand->id,
                    'batch' => $batch,
                    'status' => 1,
                    'is_used' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                 ]); 

                 if(!$codeCreate){
                    \Log::info("Code Not created: " . $code);
                }
                 

                // $codeData = Code::where('code',$code)->first();
                // if(!$codeData){
                //     \Log::info("Code Not Found: " . $code);
                // }

                // if($codeData){
                    
                //      $orderDelete = Order::where('code_id',$codeData->id)->delete();
                //      $codeDelete = Code::where('code',$code)->delete();
                // }
               

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
            '*.1' => ['sometimes'],
            '*.2' => ['sometimes'],
            '*.3' => ['sometimes'],
            '*.4' => ['sometimes'],
            '*.5' => ['sometimes'],
            '*.6' => ['sometimes'],
            '*.7' => ['sometimes'],
            '*.8' => ['sometimes'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' =>'Code',
            '1' => 'Value',
            '2' => 'Is Used',
            '3' => 'Batch',
            '4' => 'WD Code',
            '5' => 'Status',
            '6' => 'Used At',
            '7' => 'Status1',
            '8' => 'Brand'
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
