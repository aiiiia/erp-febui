<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok;

use App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\ElementTemplate\DataPelatihanKelompok;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPelatihanKelompok implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Kelompok Pelatihan' => new DataPelatihanKelompok(),
        ];
    }
}
