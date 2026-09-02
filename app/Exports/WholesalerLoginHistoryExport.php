<?php

namespace App\Exports;

use App\Models\{WholesalerLoginHistory};
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class WholesalerLoginHistoryExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
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
           "Trigger Message",
           "Journey Completed",
           "Created At",
        ];
    }

    public function map($results): array
    {   
        return [
            $results->wholesaler->full_name,
            $results->wholesaler->mobile_number,
            $results->trigger_message,
            $results->journey_completed == 1 ? "Yes" : "No",
            $results->created_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $wholesalerLoginHistory = WholesalerLoginHistory::with(['wholesaler'])
                                ->whereBetween('created_at',[$this->startDate, $this->endDate])
                                ->orderBy('created_at','ASC')
                                ->get();
        return $wholesalerLoginHistory;
    }

}
