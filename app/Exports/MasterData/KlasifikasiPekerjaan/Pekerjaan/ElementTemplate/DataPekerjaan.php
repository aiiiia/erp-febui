<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan\ElementTemplate;

use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPekerjaan implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $kelompok, $unit;
    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function title(): string
    {
        return 'Data Pekerjaan';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kelompok = $this->kelompok;

        return RefPekerjaan::select([
            'ref_pekerjaan.id',
            'ref_pekerjaan.kode',
            'ref_pekerjaan_kelompok.nama',
            'ref_pekerjaan.nama',
        ])
            ->leftJoin('ref_pekerjaan_kelompok','ref_pekerjaan.id_kelompok', '=', 'ref_pekerjaan_kelompok.id')
            ->when($kelompok, function ($filter) use ($kelompok) {
                $filter->where('ref_pekerjaan.id_kelompok', $kelompok);
            })
            ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Pekerjaan",
            "Kode Pekerjaan",
            "Nama Kelompok",
            "Nama Pekerjaan",
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
