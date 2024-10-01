<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok;

use App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPekerjaanKelompok implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Kelompok Pekerjaan' => new TemplateImportData,
        );
    }
}
