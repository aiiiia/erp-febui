<?php

namespace App\Exports\Pegawai;

use App\Exports\Pegawai\ElementTemplate\DataPegawai;
use App\Exports\Position\ElementTemplate\DataPosition;
use App\Exports\PositionLevel\ElementTemplate\DataPositionLevel;
use App\Exports\Pegawai\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPegawai implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Pegawai' => new TemplateImportData,
            'Data Position'           => new DataPosition,
            'Data BOD Type'     => new DataPositionLevel,
        );
    }
}
