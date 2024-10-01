<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor;

use App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\ElementTemplate\DataIndustriSektor;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataIndustriSektor implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Sektor Industri' => new DataIndustriSektor(),
        ];
    }
}
