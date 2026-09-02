<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Permission;
use Maatwebsite\Excel\Concerns\{ToModel, ToCollection, Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, WithStartRow, WithValidation, WithChunkReading, WithEvents};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class PermissionImport implements ToCollection, WithStartRow, WithValidation
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
                $is_parent = $row[1] ?? 0;
                $parent_name= $row[2];

                $slug = Str::slug($name, '_');
                $parentSlug = Str::slug($parent_name, '_');

                $parent_id = ($is_parent == 1) ? NULL : Permission::where('slug', $parentSlug)->value('id');

                $permission = Permission::updateOrCreate([
                    'slug' => $slug,
                ],[
                    'name' => $name,
                    'parent_id' => $parent_id,
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
            '*.1' => ['sometimes'],
            '*.2' => ['sometimes'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'Name',
            '1' => 'Has Parent',
            '2' => 'Parent Name',
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
