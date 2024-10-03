<?php

namespace App\Exports\MasterData\Honor\HonorRiset;

use App\Exports\MasterData\Honor\HonorRiset\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportHonorRiset implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Honor Riset' => new TemplateImportData
        );
    }
}
