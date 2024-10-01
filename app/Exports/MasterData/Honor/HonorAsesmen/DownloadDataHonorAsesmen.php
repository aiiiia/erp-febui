<?php

namespace App\Exports\MasterData\Honor\HonorAsesmen;

use App\Exports\MasterData\Honor\HonorAsesmen\ElementTemplate\DataHonorAsesmen;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataHonorAsesmen implements WithMultipleSheets
{
    private $kelompok;

    public function __construct()
    {
    }

    public function sheets(): array
    {
        return [
            'Data Honor Asesmen' => new DataHonorAsesmen(),
        ];
    }
}
