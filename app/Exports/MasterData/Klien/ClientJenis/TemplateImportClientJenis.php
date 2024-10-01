<?php

namespace App\Exports\MasterData\Klien\ClientJenis;

use App\Exports\MasterData\Klien\ClientJenis\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportClientJenis implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Jenis Client' => new TemplateImportData,
        );
    }
}
