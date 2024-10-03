<?php

namespace App\Exports\MasterData\Honor\HonorTraining;

use App\Exports\MasterData\Honor\HonorTraining\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportHonorTraining implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Honor Training' => new TemplateImportData
        );
    }
}
