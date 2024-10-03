<?php

namespace App\Exports\MasterData\Honor\HonorTraining;

use App\Exports\MasterData\Honor\HonorTraining\ElementTemplate\DataHonorTraining;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DownloadDataHonorTraining implements WithMultipleSheets
{
    private $kelompok;

    public function __construct()
    {
    }

    public function sheets(): array
    {
        return [
            'Data Honor Training' => new DataHonorTraining(),
        ];
    }
}
