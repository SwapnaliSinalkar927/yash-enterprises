<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CodeExport implements WithMultipleSheets
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Fetch all brands that have codes in this date range
        $brands = Brand::whereHas('codes', function ($query) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        })->get();

        foreach ($brands as $brand) {
            $sheets[] = new CodeExportPerBrand($brand->id, $brand->name, $this->startDate, $this->endDate);
        }

        return $sheets;
    }
}
