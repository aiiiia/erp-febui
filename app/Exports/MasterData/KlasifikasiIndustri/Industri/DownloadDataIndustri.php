<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\Industri;

use App\Exports\MasterData\KlasifikasiIndustri\Industri\ElementTemplate\DataIndustri;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataIndustri implements WithMultipleSheets
{
    private $sektor;

    public function __construct($sektor)
    {
        $this->sektor = $sektor;
    }

    public function sheets(): array
    {
        return [
            'Data Industri' => new DataIndustri($this->sektor),
        ];
    }
}
