<?php

namespace App\Exports\Position;

use App\Exports\Position\ElementTemplate\DataPosition;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPosition implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Position' => new DataPosition(),
        ];
    }
}
