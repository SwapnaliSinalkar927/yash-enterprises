<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Carbon\Carbon;

class OrderExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return[
            'WD Code',
            'Wholesaler',
            'Wholesaler Mobile Number',
            'Pincode',
            'Code Used',
            "Brand",
            "Value",
            "Created At"
        ];
    }

    public function map($result): array
    {   
        return [
            $result->code->wd->code,
            $result->wholesaler->full_name,
            $result->wholesaler->mobile_number,
            $result->wholesaler->pincode,
            $result->code->code,
            $result->brand->name,
            $result->value,
            $result->created_at
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'Q') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Q1')->getFont()->setBold(true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = Order::with('wholesaler','code','brand','code.wd')->orderBy('created_at','ASC')->get();
        return $result;
    }
}

