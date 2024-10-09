<?php

namespace App\Exports\Position\ElementTemplate;

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
        return 'Template Import Position';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh Id',
            'Contoh Code Position Level',
            'Contoh Code Position Type',
            'Contoh Code Unit',
            'Contoh Code Position',
            'Contoh Nama Position',
            'Contoh Org Level',
            'Contoh Line Manager',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Code Position Level',
            'Code Position Type',
            'Code Unit',
            'Code Position',
            'Nama Position',
            'Org Level',
            'Line Manager',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "h") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
