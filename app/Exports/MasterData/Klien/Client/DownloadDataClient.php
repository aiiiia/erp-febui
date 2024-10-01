<?php

namespace App\Exports\MasterData\Klien\Client;

use App\Exports\MasterData\Klien\Client\ElementTemplate\DataClient;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataClient implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Client' => new DataClient(),
        ];
    }
}
