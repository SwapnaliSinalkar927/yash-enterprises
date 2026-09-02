<?php

namespace App\Exports;

use App\Models\LatestCode;
use Maatwebsite\Excel\Concerns\{FromCollection, WithTitle, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LatestCodePerSectionExport implements FromCollection, WithTitle, WithMapping, WithHeadings, WithEvents, WithStyles
{
    protected $wd;
    protected $startDate;
    protected $endDate;

    public function __construct($wd, $startDate, $endDate)
    {
        $this->wd = $wd;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function title(): string
    {
        return "Section" . '-' . substr($this->wd, 0, 31); // Excel sheet name limit
    }

    public function headings(): array
    {
        return [
            'Dist',
            'WD Code',
            'Denomination',
            'Code',
            'Value',
            'Is Used',
            'Status',
            'Used At'
        ];
    }

    public function map($code): array
    {
        $firstOrder = $code->latestOrders->first();
        return [
            $code->latestWd->district,
            $code->latestWd->code,
            $code->denomination,
            $code->code,
            $code->value,
            $code->is_used ? "Yes" : "No",
            $code->status,
            $firstOrder->created_at ?? 'Not Used',
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
        return LatestCode::with(['brand', 'latestWd', 'latestOrders'])
        // ->where('brand_id', $this->brandId)
        ->whereHas('latestWd', function ($query) {
            $query->where('section_name', $this->wd);
        })
        ->whereBetween('created_at', [$this->startDate, $this->endDate])
        ->orderBy('code', 'asc')
        ->get();
        }
}
