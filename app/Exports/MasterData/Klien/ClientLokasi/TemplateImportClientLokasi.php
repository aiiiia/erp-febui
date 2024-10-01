<?php

namespace App\Exports\MasterData\Klien\ClientLokasi;

use App\Exports\MasterData\Klien\ClientLokasi\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportClientLokasi implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Lokasi Client' => new TemplateImportData,
        );
    }
}
