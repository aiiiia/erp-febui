<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok;

use App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\ElementTemplate\TemplateImportData;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPelatihanKelompok implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Kelompok Pelatihan' => new TemplateImportData,
        );
    }
}
