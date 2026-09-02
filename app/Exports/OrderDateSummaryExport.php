<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use Carbon\Carbon;

class OrderDateSummaryExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles
{
    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        $headings = [
           'State'
        ];

        foreach ($this->getArrayOfDates() as $date) {
            $headings[] = $date;
        }
      // Add 'Grand Total' as the last column
        $headings[] = 'Grand Total';

        return $headings;
    }

    public function map($result): array
    {   
        return array_values($result);
    }

    public function registerEvents(): array
    {
        // return [
        //     AfterSheet::class => function (AfterSheet $event) {
        //         // Dynamically calculate the range of columns based on the headings
        //         $columnCount = count($this->getArrayOfDates()) + 2; // Add 2 for 'State' and 'Grand Total'
        //         $lastColumn = chr(64 + $columnCount); // Convert column count to letter (A=1, B=2, etc.)
                
        //         // Set auto-size for all columns dynamically
        //         foreach (range('A', $lastColumn) as $column) {
        //             $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
        //         }
        //     },
        // ];

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('H')->setAutoSize(true);         
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Dynamically calculate the last column based on the number of headings
        $columnCount = count($this->getArrayOfDates()) + 2; // Add 2 for 'State' and 'Grand Total'

        // Convert column count to Excel column letters (e.g., 1 => A, 26 => Z, 27 => AA, etc.)
        $lastColumn = $this->getExcelColumnLetter($columnCount);

        // Apply styles to the header row
        $sheet->getStyle("A1:{$lastColumn}1")->getFont()->setBold(true);
    }

/**
 * Convert a column number to Excel column letter (e.g., 1 => A, 27 => AA)
 */
    private function getExcelColumnLetter($columnNumber)
    {
        $columnLetter = '';
        while ($columnNumber > 0) {
            $columnNumber--;
            $columnLetter = chr($columnNumber % 26 + 65) . $columnLetter;
            $columnNumber = intdiv($columnNumber, 26);
        }
        return $columnLetter;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
  
    public function collection()
    {
        // Fetch orders with related wholesaler and state data
        $orders = Order::with([
            'wholesaler',
            'wholesaler.wd:id,code,state',
        ])->get();

        // Prepare an array of dates spanning the range of orders
        $dates = $this->getArrayOfDates();

        // Group the orders by state and date
        $groupedData = $orders->groupBy([
            function ($order) {
                return $order->wholesaler->wd->state ?? 'Unknown State'; // Handle null states
            },
            function ($order) {
                return $order->created_at->toDateString(); // Group by date
            }
        ]);

        // Flatten the grouped data into rows
        $flattenedData = [];
        foreach ($groupedData as $state => $dateData) {
            // Initialize all dates with "0"
            $row = ['State' => $state];
            foreach ($dates as $date) {
                $row[$date] = isset($dateData[$date]) ? (string) $dateData[$date]->count() : "0";
            }
            $row['Total'] = array_sum(array_map('intval', array_slice($row, 1))); // Calculate total orders for the state
            $flattenedData[] = $row;
        }

        // Add a grand total row
        $grandTotalRow = ['State' => 'Grand Total'];
        foreach ($dates as $date) {
            $grandTotalRow[$date] = (string) array_sum(array_map('intval', array_column($flattenedData, $date)));
        }
        $grandTotalRow['Total'] = array_sum(array_map('intval', array_column($flattenedData, 'Total')));
        $flattenedData[] = $grandTotalRow;

        // Return a collection for the export
        return collect($flattenedData);
    }

    
 
    private function getArrayOfDates(){
        $orderFirstEntry = Order::orderBy('created_at', 'ASC')->first();
        $orderLastEntry = Order::orderBy('created_at', 'DESC')->first();
        
        $initialDate = $orderFirstEntry ? Carbon::parse($orderFirstEntry->created_at)->startOfDay() : null;
        $lastDate = $orderLastEntry ? Carbon::parse($orderLastEntry->created_at)->endOfDay() : null;
        // dd($initialDate,$lastDate);
        $dateArray = [];
        
        if ($initialDate && $lastDate) {
            $currentDate = $initialDate->copy(); // Make a copy of the initial date
        
            while ($currentDate->lte($lastDate)) {
                $dateArray[] = $currentDate->toDateString(); // Add current date to the array
                $currentDate->addDay(); // Increment the date by one day
            }
        }
        // dd($dateArray);
        return $dateArray;
    }
}

