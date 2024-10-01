<?php

namespace App\Exports\MasterData\Honor\HonorAsesmen\ElementTemplate;

use App\Models\MasterData\Honor\RefHonorAsesmen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataHonorAsesmen implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Honor Asesmen';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefHonorAsesmen::select([
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
