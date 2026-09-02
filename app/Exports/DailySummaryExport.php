<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DailySummaryExport implements WithMultipleSheets
{
    use Exportable;

    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Add the summary sheet
        $sheets[] = new SummarySheetExport($this->startDate, $this->endDate);

        $dateRange = collect();
        $start = strtotime($this->startDate);
        $end = strtotime($this->endDate);

        while ($start <= $end) {
            $dateRange->push(date('Y-m-d', $start));
            $start = strtotime("+1 day", $start);
        }

        foreach ($dateRange as $date) {
            $sheets[] = new DailySheetExport($date); // Pass each date to DailySheetExport
        }

        return $sheets;
    }
}
