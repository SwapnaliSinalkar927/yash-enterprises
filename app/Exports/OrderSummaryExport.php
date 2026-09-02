<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OrderSummaryExport implements WithMultipleSheets
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
 
    public function sheets(): array
    {
        // Return each export class as a separate sheet
        return [
            new OrderDateSummaryExport(),
            new WholesalerOrdersPerWeekExport(),
        ];
    }
}

