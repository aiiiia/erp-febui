<?php

namespace App\Exports\Pegawai\ElementTemplate;

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
        return 'Template Import Pegawai';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $example = [
            'Contoh ID',
            'Contoh NIP',
            'Contoh Nama',
            'Contoh Job Title',
            'Contoh Code Position',
            'Contoh BOD Type',
            'Contoh Tempat Lahir',
            'Contoh Alamat',
            'Contoh No KTP',
            'Contoh No NPWP',
            'Contoh email',
            'Contoh No HP',
        ];

        return collect([$example]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIP',
            'Nama',
            'Job Title',
            'Code Position',
            'BOD Type',
            'Tempat Lahir',
            'Alamat',
            'No KTP',
            'No NPWP',
            'email',
            'No HP',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "l") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }

    public function registerEvents(): array
    {
        return [];
    }
}
