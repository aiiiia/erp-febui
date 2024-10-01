<?php

namespace App\Exports\Pegawai;

use App\Exports\Pegawai\ElementTemplate\DataPegawai;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataPegawai implements WithMultipleSheets
{
    public function __construct()
    {
        //
    }

    public function sheets(): array
    {
        return [
            'Data Pegawai' => new DataPegawai(),
        ];
    }
}
