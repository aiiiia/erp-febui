<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\ElementTemplate;

use App\Models\MasterData\KlasifikasiIndustri\RefIndustriSektor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataIndustriSektor implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $industriSektor;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Sektor Industri';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $industriSektor = $this->industriSektor;

        return RefIndustriSektor::select([
            'id',
            'nama',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Sektor Industri",
            "Nama Sektor Industri",
        ];
    }

    // * Styling Cell
    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "b") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }
}
