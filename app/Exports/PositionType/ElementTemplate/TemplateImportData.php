<?php

namespace App\Exports\PositionType\ElementTemplate;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateImportData implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle, WithStyles
{
    public function title(): string
    {
        return 'Template Import Position Type';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Position Type',
            'Contoh Code Position Type',
            'Contoh Nama Position Type',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code Position Type',
            'Nama Position Type',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "c") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
