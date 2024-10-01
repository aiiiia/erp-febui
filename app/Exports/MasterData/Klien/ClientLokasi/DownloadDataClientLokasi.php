<?php

namespace App\Exports\MasterData\Klien\ClientLokasi;

use App\Exports\Client\ElementTemplate\DataClientLokasi;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataClientLokasi implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Lokasi Client' => new DataClientLokasi(),
        ];
    }
}
