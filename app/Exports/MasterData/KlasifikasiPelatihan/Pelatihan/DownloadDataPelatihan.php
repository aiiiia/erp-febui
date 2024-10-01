<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan;

use App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\ElementTemplate\DataPelatihan;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPelatihan implements WithMultipleSheets
{
    private $kelompok;

    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function sheets(): array
    {
        return [
            'Data Pelatihan' => new DataPelatihan($this->kelompok),
        ];
    }
}
