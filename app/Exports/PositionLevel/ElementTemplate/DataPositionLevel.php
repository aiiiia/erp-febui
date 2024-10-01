<?php

namespace App\Exports\PositionLevel\ElementTemplate;

use App\Models\RefPositionLevel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPositionLevel implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $positionLevel;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Position Level';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $positionLevel = $this->positionLevel;

        return RefPositionLevel::select([
            'code_position_level',
            'nama_position_level',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "Code Position Level",
            "Nama Position Level",
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
