<?php

namespace App\Exports\MasterData\Klien\ClientJenis;

use App\Exports\MasterData\Klien\ClientJenis\ElementTemplate\DataClientJenis;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataClientJenis implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Jenis Client' => new DataClientJenis(),
        ];
    }
}
