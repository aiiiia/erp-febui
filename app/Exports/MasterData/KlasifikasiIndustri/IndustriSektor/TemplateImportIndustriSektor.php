<?php

namespace App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor;

use App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportIndustriSektor implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Sektor Industri' => new TemplateImportData,
        );
    }
}
