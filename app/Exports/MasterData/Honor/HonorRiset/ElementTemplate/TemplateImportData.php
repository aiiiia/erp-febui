<?php

namespace App\Exports\MasterData\Honor\HonorRiset\ElementTemplate;

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
        return 'Template Import Honor Riset';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Honor Riset',
            'Contoh Kode Honor Riset',
            'Contoh Jenis Honor Riset',
            'Contoh Honor Honor Riset',
            'Contoh Satuan Honor Riset',
            'Contoh Keterangan Honor Riset',
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
