<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\ElementTemplate;

use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaanKelompok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPekerjaanKelompok implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $pekerjaanKelompok;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Kelompok Pekerjaan';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pekerjaanKelompok = $this->pekerjaanKelompok;

        return RefPekerjaanKelompok::select([
            'id',
            'nama',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Kelompok Pekerjaan",
            "Nama Kelompok Pekerjaan",
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
