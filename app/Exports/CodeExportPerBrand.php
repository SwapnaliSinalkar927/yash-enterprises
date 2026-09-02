<?php

namespace App\Exports;

use App\Models\Code;
use Maatwebsite\Excel\Concerns\{FromCollection, WithTitle, WithMapping, WithHeadings, WithEvents, WithStyles};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class CodeExportPerBrand implements FromCollection, WithTitle, WithMapping, WithHeadings, WithEvents, WithStyles
{
    protected $brandId;
    protected $brandName;
    protected $startDate;
    protected $endDate;

    public function __construct($brandId, $brandName, $startDate, $endDate)
    {
        $this->brandId = $brandId;
        $this->brandName = $brandName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function title(): string
    {
        return substr($this->brandName, 0, 31); // Excel sheet name limit
    }

    public function headings(): array
    {
        return [
            'Code',
            'Value',
            'Is Used',
            'Batch',
            'WD Code',
            'Status',
            'Used At'
        ];
    }

    public function map($code): array
    {
        $firstOrder = $code->orders->first();
        return [
            $code->code,
            $code->value,
            $code->is_used ? "Yes" : "No",
            $code->batch,
            $code->wd->code,
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
        return Code::with(['brand','wd','orders'])->where('brand_id', $this->brandId)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('code', 'asc')
            ->get();
    }
}
