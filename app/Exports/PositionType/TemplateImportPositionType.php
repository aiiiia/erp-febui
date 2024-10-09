<?php

namespace App\Exports\PositionType;

use App\Exports\PositionType\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPositionType implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Position Type' => new TemplateImportData,
        );
    }
}
