<?php

namespace App\Exports;

use App\Models\{Wholesaler};
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class MasterReportExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return[
            "Wholesaler Name",
            "Wholesaler Mobile Number",
            "Pincode",
            "City",
            "State",
            "WD Code",
            "Order count",
            "Created At"
            /*"Flake Nova (Packs)",
            "Flake Double Taste (Packs)",
            "Flake Advance (Packs)"*/
        ];
    }

    public function map($results): array
    {   
        return [
            $results['name'],
            $results['mobile_number'],
            $results['pincode'],
            $results['city'],
            $results['state'],
            $results['wd_code'],
            $results['orderCount'],
            $results['created_at'],
            /*$results['flake_nova'],
            $results['flake_double_taste'],
            $results['flake_advance'],*/
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'H') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $wholesalers = Wholesaler::with([
                'wd:id,code',
                'pincode:id,code',
                'city:id,name',
                'state:id,name',
                // 'orders:id,wholesaler_id,option_name,code_id',
                'orders.code:id,value',
            ])
            ->orderBy('created_at', 'ASC')
            ->get()
            ->map(function ($wholesaler) {
                $orderCount = $wholesaler->orders->count();

                // Flake calculations using predefined mappings
                /*$optionMapping = [
                    'Option 1' => ['Flake Nova' => 20, 'Flake Double Taste' => 20], // MP
                    'Option 2' => ['Flake Nova' => 20, 'Flake Advance' => 20], // Chhatisgarh
                ];

                $flakeCounts = [
                    'flake_nova' => 0,
                    'flake_double_taste' => 0,
                    'flake_advance' => 0,
                ];

                foreach ($wholesaler->orders as $order) {
                    if (isset($optionMapping[$order->option_name])) {
                        $flakeCounts['flake_nova'] += $optionMapping[$order->option_name]['Flake Nova'];
                        $flakeCounts['flake_double_taste'] += $optionMapping[$order->option_name]['Flake Double Taste'];
                        $flakeCounts['flake_advance'] += $optionMapping[$order->option_name]['Flake Advance'];
                    }
                }*/

                return [
                    'wd_code' => $wholesaler->wd->code ?? 'N/A',
                    'name' => $wholesaler->full_name ?? '',
                    'mobile_number' => $wholesaler->mobile_number ?? '',
                    'pincode' => $wholesaler->pincode->code ?? 'N/A',
                    'city' => $wholesaler->city->name ?? 'N/A',
                    'state' => $wholesaler->state->name ?? 'N/A',
                    'orderCount' => $orderCount == 0 ? "0" : $orderCount,
                    'created_at' => $wholesaler->created_at,
                    /*'flake_nova' => $flakeCounts['flake_nova'],
                    'flake_double_taste' => $flakeCounts['flake_double_taste'],
                    'flake_advance' => $flakeCounts['flake_advance'],*/
                ];
            });

        return $wholesalers;
    }

}
