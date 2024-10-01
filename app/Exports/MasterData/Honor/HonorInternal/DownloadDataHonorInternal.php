<?php

namespace App\Exports\MasterData\Honor\HonorInternal;

use App\Exports\MasterData\Honor\HonorInternal\ElementTemplate\DataHonorInternal;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataHonorInternal implements WithMultipleSheets
{
    private $kelompok;

    public function __construct()
    {
    }

    public function sheets(): array
    {
        return [
            'Data Honor Internal' => new DataHonorInternal(),
        ];
    }
}
