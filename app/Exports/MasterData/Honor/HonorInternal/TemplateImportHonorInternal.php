<?php

namespace App\Exports\MasterData\Honor\HonorInternal;

use App\Exports\MasterData\Honor\HonorInternal\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportHonorInternal implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Honor Internal' => new TemplateImportData
        );
    }
}
