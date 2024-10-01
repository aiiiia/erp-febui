<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\ElementTemplate;

use App\Models\MasterData\KlasifikasiPelatihan\RefPelatihanKelompok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPelatihanKelompok implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $pelatihanKelompok;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Kelompok Pelatihan';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pelatihanKelompok = $this->pelatihanKelompok;

        return RefPelatihanKelompok::select([
            'id',
            'nama',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Kelompok Pelatihan",
            "Nama Kelompok Pelatihan",
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
