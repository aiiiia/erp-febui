<?php

namespace App\Exports\PositionType;

use App\Exports\PositionType\ElementTemplate\DataPositionType;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPositionType implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Position Type' => new DataPositionType(),
        ];
    }
}
