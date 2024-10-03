<?php

namespace App\Exports\MasterData\Honor\HonorTraining\ElementTemplate;

use App\Models\MasterData\Honor\RefHonorTraining;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataHonorTraining implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Honor Training';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RefHonorTraining::select([
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
