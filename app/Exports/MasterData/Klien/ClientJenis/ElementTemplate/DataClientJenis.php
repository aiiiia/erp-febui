<?php

namespace App\Exports\MasterData\Klien\ClientJenis\ElementTemplate;

use App\Models\MasterData\Klien\RefClientJenis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataClientJenis implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Jenis Client';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefClientJenis::select([
                                    'ref_client_jenis.id',
                                    'ref_client_jenis.nama',
                                ])
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Jenis Client",
            "Nama Jenis Client",
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
