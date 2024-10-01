<?php

namespace App\Exports\MasterData\Klien\ClientLokasi\ElementTemplate;

use App\Models\MasterData\Klien\RefClientLokasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataClientLokasi implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Lokasi Client';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefClientLokasi::select([
                                    'ref_client_lokasi.id',
                                    'ref_client_lokasi.nama',
                                ])
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Lokasi Client",
            "Nama Lokasi Client",
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
