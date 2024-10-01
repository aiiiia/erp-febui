<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\Industri\ElementTemplate;

use App\Models\MasterData\KlasifikasiIndustri\RefIndustri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataIndustri implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $sektor, $unit;
    public function __construct($sektor)
    {
        $this->sektor = $sektor;
    }

    public function title(): string
    {
        return 'Data Industri';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $sektor = $this->sektor;

        return RefIndustri::select([
            'ref_industri.id',
            'ref_industri.kode',
            'ref_industri_sektor.nama',
            'ref_industri.nama',
        ])
            ->leftJoin('ref_industri_sektor','ref_industri.id_sektor', '=', 'ref_industri_sektor.id')
            ->when($sektor, function ($filter) use ($sektor) {
                $filter->where('ref_industri.id_sektor', $sektor);
            })
            ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Industri",
            "Kode Industri",
            "Nama Sektor",
            "Nama Industri",
        ];
    }

    // * Styling Cell
    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "d") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }
}
