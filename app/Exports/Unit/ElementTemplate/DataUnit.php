<?php

namespace App\Exports\Unit\ElementTemplate;

use App\Models\RefUnit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataUnit implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $unit;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Unit';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $unit = $this->unit;

        return RefUnit::select([
            'code_unit',
            'nama_unit',
        ])
        ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "Code Unit",
            "Nama Unit",
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
