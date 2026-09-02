<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\{TeamLeader,LatestWD};
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class TeamLeaderImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    protected $rowCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ++$this->rowCount;
            try {
                $am               = $row[0] ?? null;
                $ae               = $row[1] ?? null;
                $wdCode           = $row[2] ?? null;
                $sectionName      = $row[3] ?? null;
                $wdName           = $row[4] ?? null;
                $vanId            = $row[5] ?? null;
                $vanDsName        = $row[6] ?? null;
                $vanDsMobileNo    = $row[7] ?? null;

                $wd = LatestWD::updateOrCreate([
                    'code' => $wdCode,
                ],[
                    'firm_name' => $wdName,
                    'section_name' => $sectionName,
                    'status' => 1,
                ]);

                $tl = TeamLeader::updateOrCreate([
                    'mobile_number' => $vanDsMobileNo,
                ],[
                    'latest_wd_id' => $wd->id,
                    'name' => $vanDsName,
                    'tl_id' => $vanId,
                    'am' => $am,
                    'ae' => $ae,
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
            '*.0' => ['sometimes'],        // AM
            '*.1' => ['sometimes'],        // AE
            '*.2' => ['required'],        // WD Code
            '*.3' => ['sometimes'],        // Section Name
            '*.4' => ['sometimes'],        // WD Name
            '*.5' => ['sometimes'],        // VAN ID
            '*.6' => ['required'],        // Van DS Name
            '*.7' => ['required']
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'AM',
            '1' => 'AE',
            '2' => 'WD Code',
            '3' => 'Section Name',
            '4' => 'WD Name',
            '5' => 'VAN ID',
            '6' => 'Van DS Name',
            '7' => 'Van DS Mobile Number',
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
