<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Wholesaler;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\{WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummaryReportExport implements FromArray, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function array(): array
    {
        // Define targets for each state
        $targets = [
            'Chhattisgarh' => [
                'wholesalers' => 2500,
                'coupons' => 2600
            ],
            'Madhya Pradesh' => [
                'wholesalers' => 5000,
                'coupons' => 6000
            ],
        ];

        // Initialize data array
        $data = [];

        // Loop through each state to get the data
        foreach ($targets as $state => $target) {
            // Count wholesalers in the given state
            $wholesalersInState = Wholesaler::whereHas('wd', function ($query) use ($state) {
                $query->where('state', $state);
            })->whereBetween('created_at',[$this->startDate, $this->endDate])->count();

            // Count coupons utilized in the given state
            // $couponsUtilizedInState = Order::whereHas('wholesaler.wd', function ($query) use ($state) {
            //     $query->where('state', $state);
            // })->where('reward_status', 1)->count();
            $couponsUtilizedInState = Order::whereHas('wholesaler.wd', function ($query) use ($state) {
                $query->where('state', $state);
            })->whereBetween('created_at',[$this->startDate, $this->endDate])->count();

            // Calculate percentages
            $percentageWholesalers = $target['wholesalers'] > 0 ? ($wholesalersInState / $target['wholesalers']) * 100 : 0;
            $percentageCoupons = $target['coupons'] > 0 ? ($couponsUtilizedInState / $target['coupons']) * 100 : 0;

            // Store the result in the data array
            $data[] = [
                'State' => $state,
                'Number of target SWDs + DS' => $target['wholesalers'],
                'Number of SWDs + DS enrolled' => $wholesalersInState,
                'Wholesalers Percentage' => number_format($percentageWholesalers, 2) . '%',
                'Target Coupons to be Utilized' => $target['coupons'],
                'Number of coupons utilised' => $couponsUtilizedInState,
                'Coupons Percentage' => number_format($percentageCoupons, 2) . '%',
            ];
        }

        // Include a row for wholesalers with null 'wd'
        $wholesalersWithNoWD = Wholesaler::whereNull('wd_id')->whereBetween('created_at',[$this->startDate, $this->endDate])->count();
        $couponsUtilizedWithNoWD = Order::whereHas('wholesaler', function ($query) {
            $query->whereNull('wd_id');
        })->whereBetween('created_at',[$this->startDate, $this->endDate])->where('reward_status', 1)->count();

        $data[] = [
            'State' => 'No WD',
            'Number of target SWDs + DS' => 0,  // No target for this row
            'Number of SWDs + DS enrolled' => $wholesalersWithNoWD,
            'Wholesalers Percentage' => $wholesalersWithNoWD > 0 ? 'N/A' : '0%',
            'Target Coupons to be Utilized' => 0,  // No target for this row
            'Number of coupons utilised' => $couponsUtilizedWithNoWD,
            'Coupons Percentage' => $couponsUtilizedWithNoWD > 0 ? 'N/A' : '0%',
        ];
 
        return $data;
    }



    public function headings(): array
    {
        return [
            'Branch',
            'Number of target SWDs + DS',
            'Number of SWDs + DS enrolled',
            'Wholesalers Percentage',
            'Target Coupons to be Utilized',
            'Number of coupons utilised',
            'Coupons Percentage',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'G') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A')->getFont()->setBold(true);
    }
}

