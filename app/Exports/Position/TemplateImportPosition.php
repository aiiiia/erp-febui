<?php

namespace App\Exports\Position;

use App\Exports\PositionLevel\ElementTemplate\DataPositionLevel;
use App\Exports\PositionType\ElementTemplate\DataPositionType;
use App\Exports\Unit\ElementTemplate\DataUnit;
use App\Exports\Position\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPosition implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Position' => new TemplateImportData,
            'Data Position Level' => new DataPositionLevel,
            'Data Position Type' => new DataPositionType,
            'Data Unit' => new DataUnit,
        );
    }
}
