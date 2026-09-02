<?php

namespace App\Exports;

use App\Models\LatestOrder;
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Carbon\Carbon;

class LatestOrderExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return[
            'Dist',
            'WD Code',
            'Wholesaler',
            'Wholesaler Mobile Number',
            'Type',
            'Pincode',
            'Code Used',
            "Brand",
            "Value (M)",
            "Created At"
        ];
    }

    public function map($result): array
    {   
        return [
            $result->latestCode->latestWd->town ?? null,
            $result->latestCode->latestWd->code,
            $result->latestWholesaler->full_name,
            $result->latestWholesaler->mobile_number,
            $result->latestWholesaler->type,
            $result->latestWholesaler->pincode,
            $result->latestCode->code,
            $result->brand->name,
            $result->value,
            $result->created_at
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'J') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = LatestOrder::with('latestWholesaler','latestCode','brand','latestCode.latestWd')->whereBetween('created_at',[$this->startDate, $this->endDate])->orderBy('created_at','ASC')->get();
        return $result;
    }
}

