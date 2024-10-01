<?php

namespace App\Exports\MasterData\Klien\Client\ElementTemplate;

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
        return 'Template Import Client';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID Client',
            'Contoh Initial Client',
            'Contoh Nama Client',
            'Contoh Alamat Client',
            'Contoh Lokasi Client',
            'Contoh No Telepon',
            'Contoh Jenis Instansi',
            'Contoh Sumber Dana',
            'Contoh No NPWP',
            'Contoh Status Wapu',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Initial',
            'Nama',
            'Alamat',
            'ID Lokasi',
            'No Telepon',
            'ID Jenis',
            'ID Sumber Dana',
            'No NPWP',
            'Status Wapu',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "j") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
