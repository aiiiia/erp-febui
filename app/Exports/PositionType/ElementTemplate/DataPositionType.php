<?php

namespace App\Exports\PositionType\ElementTemplate;

use App\Models\RefPositionType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPositionType implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $positionType;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Position Type';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $positionType = $this->positionType;

        return RefPositionType::select([
            'code_position_type',
            'nama_position_type',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "Code Position Type",
            "Nama Position Type",
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
