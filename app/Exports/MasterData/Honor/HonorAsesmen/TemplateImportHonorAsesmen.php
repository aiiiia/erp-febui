<?php

namespace App\Exports\MasterData\Honor\HonorAsesmen;

use App\Exports\MasterData\Honor\HonorAsesmen\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportHonorAsesmen implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Honor Asesmen' => new TemplateImportData
        );
    }
}
