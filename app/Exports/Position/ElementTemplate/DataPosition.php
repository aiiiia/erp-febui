<?php

namespace App\Exports\Position\ElementTemplate;

use App\Models\RefPosition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPosition implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $Position;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Position';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Position = $this->Position;

        return RefPosition::select([
                                    'ref_position.code_position',
                                    'ref_position.nama_position',
                                    'ref_position_level.nama_position_level',
                                    'ref_position_type.nama_position_type',
                                    'ref_unit.nama_unit',
                                    'ref_position.line_manager',
                                ])
                                ->join('ref_position_level', 'ref_position_level.code_position_level', 'ref_position.code_position_level')
                                ->join('ref_position_type', 'ref_position_type.code_position_type', 'ref_position.code_position_type')
                                ->join('ref_unit', 'ref_unit.code_unit', 'ref_position.code_unit')
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "Code Position",
            "Nama Position",
            "Position Level",
            "Position Type",
            "Unit",
            "Line Manager",
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
