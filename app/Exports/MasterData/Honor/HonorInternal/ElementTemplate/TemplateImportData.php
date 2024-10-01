<?php

namespace App\Exports\MasterData\Honor\HonorInternal\ElementTemplate;

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
        return 'Template Import Honor Internal';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Honor Internal',
            'Contoh Kode Honor Internal',
            'Contoh Jenis Honor Internal',
            'Contoh Honor Honor Internal',
            'Contoh Satuan Honor Internal',
            'Contoh Keterangan Honor Internal',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode',
            'Jenis',
            'Honor',
            'Satuan',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "f") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
