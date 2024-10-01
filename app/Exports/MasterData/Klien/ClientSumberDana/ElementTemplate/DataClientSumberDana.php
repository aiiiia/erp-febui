<?php

namespace App\Exports\MasterData\Klien\ClientSumberDana\ElementTemplate;

use App\Models\MasterData\Klien\RefClientSumberDana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataClientSumberDana implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Client Sumber Dana';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefClientSumberDana::select([
                                    'ref_client_sumber_dana.id',
                                    'ref_client_sumber_dana.nama',
                                ])
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID Sumber Dana Client",
            "Nama Client",
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
