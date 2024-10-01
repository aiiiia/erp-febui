<?php

namespace App\Exports\Unit;

use App\Exports\Unit\ElementTemplate\DataUnit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataUnit implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Unit' => new DataUnit(),
        ];
    }
}
