<?php

namespace App\Exports\Unit;

use App\Exports\Unit\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportUnit implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Unit' => new TemplateImportData,
        );
    }
}
