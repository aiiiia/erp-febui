<?php

namespace App\Exports\PositionLevel;

use App\Exports\PositionLevel\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPositionLevel implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Position Level' => new TemplateImportData,
        );
    }
}
