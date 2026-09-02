<?php

namespace App\Exports;

use App\Models\{LatestWholesaler,LatestCode,Brand, LatestOrder};
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LatestWholesalerExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
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
            "Type",
            "Pincode",
            "Address",
            "Lat",
            "Lng",
            // "UPI ID",
            "Let's Connect",
            "Created At",
        ];
    }

    public function map($results): array
    {   
        return [
            $results->full_name,
            $results->mobile_number,
             $results->typr,
            $results->pincode,
            $results->address,
            $results->lat,
            $results->long,
            // $results->upi_id,
            $results->lcOrder == 0 ? "0" : $results->lcOrder,
            $results->created_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestColumn = $sheet->getHighestColumn();
                $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

                for ($colIndex = 1; $colIndex <= $highestColumnIndex; $colIndex++) {
                    $columnLetter = Coordinate::stringFromColumnIndex($colIndex);
                    $sheet->getColumnDimension($columnLetter)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();

        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        $range = 'A1:' . Coordinate::stringFromColumnIndex($highestColumnIndex) . '1';

        $sheet->getStyle($range)->getFont()->setBold(true);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $wholesalers = LatestWholesaler::whereBetween('created_at', [$this->startDate, $this->endDate])
        //     ->orderBy('created_at', 'ASC')
        //     ->get();

        $brands = Brand::pluck('id', 'short_code'); // e.g. ['CC' => 1, 'FM' => 2, 'VS' => 3]

        $wholesalers = LatestWholesaler::with('latestOrders')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'ASC')
            ->get()
            ->map(function ($wholesaler) use ($brands) {

                // Loop through each brand dynamically
                foreach ($brands as $shortCode => $brandId) {
                    $totalValue = LatestOrder::where('latest_wholesaler_id', $wholesaler->id)
                        ->where('brand_id', $brandId)
                        ->sum('value');

                    // Dynamically assign property name like ->ccOrder, ->fmOrder, etc.
                    $property = strtolower($shortCode) . 'Order';
                    $wholesaler->$property = $totalValue;
                }

                return $wholesaler;
            });

            // dd($wholesalers);

        return $wholesalers;

    }


}
