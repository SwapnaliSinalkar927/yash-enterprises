<?php

namespace App\Exports;

use App\Models\Wholesaler;
use App\Models\City;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummarySheetExport implements FromArray, WithHeadings, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function array(): array
    {
        $data = [];
        $totals = [
            'New Wholesalers' => 0,
            'New Cities' => 0,
        ];

        // Generate date range
        $dateRange = [];
        $start = strtotime($this->startDate);
        $end = strtotime($this->endDate);

        while ($start <= $end) {
            $dateRange[] = date('Y-m-d', $start);
            $start = strtotime("+1 day", $start);
        }

        // Prepare rows
        $newWholesalersRow = ['New Wholesalers'];
        $newCitiesRow = ['New Cities'];

        foreach ($dateRange as $date) {
            // New Wholesalers for the day
            $newWholesalers = Wholesaler::whereDate('created_at', $date)->count();
            $totals['New Wholesalers'] += $newWholesalers;
            $newWholesalersRow[] = $newWholesalers;

            // New Cities for the day
            $newCities = Wholesaler::whereDate('created_at', $date)
                ->distinct('city_id')
                ->whereNotNull('city_id')
                ->pluck('city_id')
                ->count();
            $totals['New Cities'] += $newCities;
            $newCitiesRow[] = $newCities;
        }

        // Append totals
        $newWholesalersRow[] = $totals['New Wholesalers'];
        $newCitiesRow[] = $totals['New Cities'];

        // Add rows to data
        $data[] = $newWholesalersRow;
        $data[] = $newCitiesRow;

        return $data;
    }

    public function headings(): array
    {
        // Generate date range headings
        $headings = ['Summary'];
        $start = strtotime($this->startDate);
        $end = strtotime($this->endDate);

        while ($start <= $end) {
            $headings[] = date('Y-m-d', $start);
            $start = strtotime("+1 day", $start);
        }

        $headings[] = 'Total'; // Add Total column
        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the headings
            1 => ['font' => ['bold' => true]],
        ];
    }
}

