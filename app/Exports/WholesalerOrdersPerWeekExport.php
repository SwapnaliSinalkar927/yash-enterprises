<?php

namespace App\Exports;

use App\Models\{Order};
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\{FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class WholesalerOrdersPerWeekExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithStyles, ShouldQueue
{
    protected $lastState = null;
    protected $lastCity = null;
    protected $cityTotals = [];
    protected $stateTotals = [];
    private $wholesalerCity = [];
    private $currentRowIndex = 2; 
    private $cityTotalRows = [];
    private $stateTotalRows = [];

    public function dateRange($startDate,$endDate){
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    

    public function headings(): array
    {
        $headings = [
            'State',
            'City',
            'Wholesaler Mobile Number',
        ];
        foreach ($this->getArrayOfWeeks() as $week) {
            $headings[] = $week;
        }
        $headings[] = "Grand Total";
  
        return $headings;
    }

    public function map($data): array
    {
        // Retrieve all weekly columns dynamically
        $allWeeklyColumns = $this->getArrayOfWeeks()->toArray(); // Convert collection to array

        // Get weekly data as an array
        $weekDataColumns = $data['weekly_data']->toArray(); // Contains key-value pairs like 'Wk4 Dec' => 5

        // Initialize weekly columns with zeros for missing weeks
        $weekColumns = [];
        foreach ($allWeeklyColumns as $week) {
            $weekColumns[] = $weekDataColumns[$week] ?? "0"; // Use 0 if the week is not present
        }

        // Check if the current state and city are the same as the last displayed
        $state = $data['state'] === $this->lastState ? '' : $data['state'];
        $city = $data['city'] === $this->lastCity ? '' : $data['city'];

        // Update the last displayed state and city
        $this->lastState = $data['state'];
        $this->lastCity = $data['city'];

        // Add the current row data
        $orderdata = array_merge([
            $state,
            $city,
            $data['mobile'],
        ], $weekColumns, [
            $data['total_orders'], // Add the grand total at the end
        ]);

        // Update city totals
        if (!isset($this->cityTotals[$data['city']])) {
            $this->cityTotals[$data['city']] = [
                'weekly_totals' => [],
                'total_orders' => 0,
            ];
        }

        foreach ($weekDataColumns as $week => $value) {
            $this->cityTotals[$data['city']]['weekly_totals'][$week] =
                ($this->cityTotals[$data['city']]['weekly_totals'][$week] ?? 0) + $value;
        }
        $this->cityTotals[$data['city']]['total_orders'] += $data['total_orders'];

        // Update state totals
        if (!isset($this->stateTotals[$data['state']])) {
            $this->stateTotals[$data['state']] = [
                'weekly_totals' => [],
                'total_orders' => 0,
            ];
        }

        foreach ($weekDataColumns as $week => $value) {
            $this->stateTotals[$data['state']]['weekly_totals'][$week] =
                ($this->stateTotals[$data['state']]['weekly_totals'][$week] ?? 0) + $value;
        }
        $this->stateTotals[$data['state']]['total_orders'] += $data['total_orders'];

        // Determine next state and city
        $mobile_number = $data['mobile'];
        $index = null;

        // Find the index of the mobile number
        foreach ($this->wholesalerCity as $key => $value) {
            if ($value['wholesaler'] === $mobile_number) {
                $index = $key; // Set index if mobile number matches
                break; // Stop the loop once you find the match
            }
        }

        // Check if the next index exists and retrieve the next city/state
        $nextCity = null; // Default value for nextCity
        if (isset($this->wholesalerCity[$index + 1])) {
            $nextCity = $this->wholesalerCity[$index + 1]['city'];
        }

        $nextState = null; // Default value for nextState
        if (isset($this->wholesalerCity[$index + 1])) {
            $nextState = $this->wholesalerCity[$index + 1]['state'];
        }

        // Add total rows if the next city is not the same as the current city
        $totalRows = [];
        if (!$nextCity || $nextCity !== $data['city']) {
            $totalRows[] = $this->getCityTotalRow($data['city']);

            $this->cityTotalRows[] = $this->currentRowIndex + count($totalRows);
        }
        if (!$nextState || $data['state'] !== $nextState) {
            $totalRows[] = $this->getStateTotalRow($data['state']);

            $this->stateTotalRows[] = $this->currentRowIndex + count($totalRows);
        }

        $this->currentRowIndex += 1 + count($totalRows);

        // Return current row and any total rows
        return array_merge([$orderdata], $totalRows);
    }

    protected function getCityTotalRow($city)
    {
        $cityTotal = $this->cityTotals[$city];

        // Initialize row with static columns
        $row = [
            '', // Empty state column
            $city . " Total", // City total label
            '', // Empty mobile number
        ];

        // Append weekly totals dynamically
        foreach ($this->getArrayOfWeeks() as $week) {
            $row[] = $cityTotal['weekly_totals'][$week] ?? "0"; // Add weekly total or 0 if missing
        }

        // Append grand total for the city
        $row[] = $cityTotal['total_orders'];

        return $row;
    }

    protected function getStateTotalRow($state)
    {
        $stateTotal = $this->stateTotals[$state];

        // Initialize row with static columns
        $row = [
            $state . " Total", // State total label
            '', // Empty city column
            '', // Empty mobile number
        ];

        // Append weekly totals dynamically
        foreach ($this->getArrayOfWeeks() as $week) {
            $row[] = $stateTotal['weekly_totals'][$week] ?? "0"; // Add weekly total or 0 if missing
        }

        // Append grand total for the state
        $row[] = $stateTotal['total_orders'];

        return $row;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Dynamically calculate the range of columns based on the headings
                $columnCount = count($this->getArrayOfWeeks()) + 4; // Add 2 for 'State' and 'Grand Total'
                $lastColumn = chr(64 + $columnCount); // Convert column count to letter (A=1, B=2, etc.)
                
                // Set auto-size for all columns dynamically
                foreach (range('A', $lastColumn) as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $columnCount = count($this->getArrayOfWeeks()) + 4; // Add 3 for 'State', 'City', 'Grand Total'
        $lastColumn = chr(64 + $columnCount); // Convert column count to letter (A=1, B=2, etc.)
    
        // Apply styles to the header row
        $sheet->getStyle("A1:{$lastColumn}1")->getFont()->setBold(true);
    
        // Style city total rows with light blue (except the first cell)
        foreach ($this->cityTotalRows as $rowNumber) {
            // Set the first cell of the city total row to white
            $sheet->getStyle("A{$rowNumber}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFFFFF'); // White background
    
            // Set the rest of the cells in the city total row to light blue
            $sheet->getStyle("B{$rowNumber}:{$lastColumn}{$rowNumber}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('D9E0E8'); // Light blue background
        }
    
        // Style state total rows as blue
        foreach ($this->stateTotalRows as $rowNumber) {
            $sheet->getStyle("A{$rowNumber}:{$lastColumn}{$rowNumber}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('6883A4'); // Blue color
        }
    }
    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $wholesalerCity = [];
        $orders = Order::with(['wholesaler', 'wholesaler.city', 'wholesaler.state'])
            ->get()
            ->sortBy(function ($order) {
                // Use state name as the primary sort key and city name as the secondary
                $stateName = $order->wholesaler->state->name ?? '';
                $cityName = $order->wholesaler->city->name ?? '';
                return $stateName . '|' . $cityName; // Combine for sorting
            });

        $wholesalerOrdersPerWeek = $orders->groupBy(function ($order) {
            return $order->wholesaler->id; // Group by wholesaler ID
        })->map(function ($orders, $wholesalerId) {
            $wholesaler = $orders->first()->wholesaler;
            $this->storeWholesalerCity($wholesaler);
            // Group orders by week
            $weeklyData = $orders->groupBy(function ($order) {
                $date = Carbon::parse($order->created_at);
                return "Wk" . $date->weekOfMonth . " " . $date->format('M'); // Group by week of month and month
            })->map(function ($weekOrders) {
                return $weekOrders->count(); // Count orders per week
            });

            // Total of all weeks for this wholesaler
            $totalOrders = $weeklyData->sum();

            return [
                'state' => $wholesaler->state->name ?? 'N/A',
                'city' => $wholesaler->city->name ?? 'N/A',
                'mobile' => $wholesaler->mobile_number,
                'weekly_data' => $weeklyData,
                'total_orders' => $totalOrders,
            ];
        });
        // dd($wholesalerOrdersPerWeek);
       return $wholesalerOrdersPerWeek;
       
    }

    private function storeWholesalerCity($wholesaler)
    {
        // Only add the wholesaler and city if not already added
        // if (!isset($wholesalerCity[$wholesaler->id])) {
            $this->wholesalerCity[] = [
                'wholesaler' => $wholesaler->mobile_number, // Assuming wholesaler's name field
                'city' => $wholesaler->city->name ?? 'N/A',
                'state' => $wholesaler->state->name ?? 'N/A',
            ];
        // }
    }


    private function getArrayOfWeeks(){
        $orders = Order::all();
        $uniqueWeeks = $orders->groupBy(function ($order) {
            $date = Carbon::parse($order->created_at);
            $weekNumber = $date->weekOfMonth; // Week of the month
            $monthName = $date->format('M');  // Short month name (e.g., Jan, Feb)
            return "Wk{$weekNumber} {$monthName}"; // Format: WkX Mon
        })->keys(); // Retrieve only unique keys

        return $uniqueWeeks;
    }
}
