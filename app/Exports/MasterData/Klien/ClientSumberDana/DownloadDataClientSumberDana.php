<?php

namespace App\Exports\MasterData\Klien\ClientSumberDana;

use App\Exports\MasterData\Klien\ClientSumberDana\ElementTemplate\DataClientSumberDana;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataClientSumberDana implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Sumber Dana Client' => new DataClientSumberDana(),
        ];
    }
}
