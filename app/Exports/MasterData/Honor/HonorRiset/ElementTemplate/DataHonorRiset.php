<?php

namespace App\Exports\MasterData\Honor\HonorRiset\ElementTemplate;

use App\Models\MasterData\Honor\RefHonorRiset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataHonorRiset implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Honor Riset';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefHonorRiset::select([
                                            'id',
                                            'kode',
                                            'jenis',
                                            'honor',
                                            'satuan',
                                            'keterangan',
                                        ])
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "ID",
            "Kode",
            "Jenis",
            "Honor",
            "Satuan",
            "Keterangan",
        ];
    }

    // * Styling Cell
    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "f") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }
}
