<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok;

use App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\ElementTemplate\DataPekerjaanKelompok;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPekerjaanKelompok implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Kelompok Pekerjaan' => new DataPekerjaanKelompok(),
        ];
    }
}
