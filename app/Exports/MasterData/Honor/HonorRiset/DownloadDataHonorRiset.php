<?php

namespace App\Exports\MasterData\Honor\HonorRiset;

use App\Exports\MasterData\Honor\HonorRiset\ElementTemplate\DataHonorRiset;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataHonorRiset implements WithMultipleSheets
{
    private $kelompok;

    public function __construct()
    {
    }

    public function sheets(): array
    {
        return [
            'Data Honor Riset' => new DataHonorRiset(),
        ];
    }
}
