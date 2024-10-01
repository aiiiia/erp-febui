<?php

namespace App\Exports\MasterData\Honor\HonorAsesmen\ElementTemplate;

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
        return 'Template Import Honor Asesmen';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Honor Asesmen',
            'Contoh Kode Honor Asesmen',
            'Contoh Jenis Honor Asesmen',
            'Contoh Satuan Honor Asesmen',
            'Contoh Keterangan Honor Asesmen',
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
        foreach (range("a", "e") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
