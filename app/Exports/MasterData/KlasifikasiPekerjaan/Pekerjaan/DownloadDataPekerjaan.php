<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan;

use App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan\ElementTemplate\DataPekerjaan;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPekerjaan implements WithMultipleSheets
{
    private $kelompok;

    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function sheets(): array
    {
        return [
            'Data Pekerjaan' => new DataPekerjaan($this->kelompok),
        ];
    }
}
