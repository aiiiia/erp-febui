<?php

namespace App\Exports\MasterData\Klien\ClientSumberDana;

use App\Exports\MasterData\Klien\ClientSumberDana\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportClientSumberDana implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Sumber Dana Client' => new TemplateImportData,
        );
    }
}
