<?php

namespace App\Exports;

use App\Models\Wholesaler;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DailySheetExport implements FromCollection, WithHeadings, WithTitle
{
    private $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Wholesaler::with(['city:id,name', 'pincode:id,code', 'state:id,name', 'wd:id,code'])
            ->whereDate('created_at', $this->date)
            ->get()
            ->map(function ($wholesaler) {
                return [
                    $wholesaler->wd?->code,
                    $wholesaler->full_name,
                    $wholesaler->mobile_number,
                    $wholesaler->city->name ?? 'N/A',
                    $wholesaler->pincode->code ?? 'N/A',
                    $wholesaler->state->name ?? 'N/A',
                    $wholesaler->created_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'WD Code',
            'Name',
            'Mobile Number',
            'City',
            'Pincode',
            'State',
            'Created At',
        ];
    }

    public function title(): string
    {
        return $this->date; // Set the title as the date
    }
}
