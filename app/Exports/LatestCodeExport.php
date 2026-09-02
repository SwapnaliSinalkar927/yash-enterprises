<?php

namespace App\Exports;

use App\Models\LatestWD;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LatestCodeExport implements WithMultipleSheets
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        $sheets = [];

        // // Fetch all brands that have codes in this date range
        // $brands = Brand::whereHas('latestCodes', function ($query) {
        //     $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        // })->get();

        // // dd($brands);

        // foreach ($brands as $brand) {
        //     $sheets[] = new LatestCodePerBrandExport($brand->id, $brand->name, $this->startDate, $this->endDate);
        // }

         // Fetch all brands that have codes in this date range
        $wds = LatestWD::select('section_name')
            ->distinct()
            ->pluck('section_name');

        foreach ($wds as $wd) {
            $sheets[] = new LatestCodePerSectionExport($wd, $this->startDate, $this->endDate);
        }

        return $sheets;
    }
}
