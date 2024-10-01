<?php

namespace App\Exports\PositionLevel;

use App\Exports\PositionLevel\ElementTemplate\DataPositionLevel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPositionLevel implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Position Level' => new DataPositionLevel(),
        ];
    }
}
