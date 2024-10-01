<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\ElementTemplate;

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
        return 'Template Import Pelatihan';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Pelatihan',
            'Contoh Kode Pelatihan',
            'Contoh ID Kelompok Pelatihan',
            'Contoh Nama Pelatihan',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode',
            'ID Kelompok',
            'Nama',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "d") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
