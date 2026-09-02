<?php

namespace App\Exports;

use App\Models\{Wholesaler,Code};
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class WholesalerExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return[
           "Wholesaler Name",
           "Mobile Number",
           "Pincode",
           "Created At",
        ];
    }

    public function map($results): array
    {   
        return [
            $results->full_name,
            $results->mobile_number,
            $results->pincode,
            $results->created_at,
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
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $wholesalers = Wholesaler::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'ASC')
            ->get();

        return $wholesalers;
    }


}
