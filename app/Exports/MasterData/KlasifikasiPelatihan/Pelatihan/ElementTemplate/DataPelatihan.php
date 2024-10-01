<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\ElementTemplate;

use App\Models\MasterData\KlasifikasiPelatihan\RefPelatihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPelatihan implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $kelompok, $unit;
    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function title(): string
    {
        return 'Data Pelatihan';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kelompok = $this->kelompok;

        return RefPelatihan::select([
            'ref_pelatihan.id',
            'ref_pelatihan.kode',
            'ref_pelatihan_kelompok.nama',
            'ref_pelatihan.nama',
        ])
            ->leftJoin('ref_pelatihan_kelompok','ref_pelatihan.id_kelompok', '=', 'ref_pelatihan_kelompok.id')
            ->when($kelompok, function ($filter) use ($kelompok) {
                $filter->where('ref_pelatihan.id_kelompok', $kelompok);
            })
            ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Pelatihan",
            "Kode Pelatihan",
            "Nama Kelompok",
            "Nama Pelatihan",
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
