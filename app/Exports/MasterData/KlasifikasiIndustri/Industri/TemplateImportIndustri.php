<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\Industri;

use App\Exports\MasterData\KlasifikasiIndustri\Industri\ElementTemplate\TemplateImportData;
use App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\ElementTemplate\DataIndustriSektor;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportIndustri implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Industri' => new TemplateImportData,
            'Data Sektor' => new DataIndustriSektor,
        );
    }
}
