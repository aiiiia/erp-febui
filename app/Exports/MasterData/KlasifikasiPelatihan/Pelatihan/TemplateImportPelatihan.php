<?php

namespace App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan;

use App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\ElementTemplate\TemplateImportData;
use App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\ElementTemplate\DataPelatihanKelompok;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPelatihan implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Pelatihan' => new TemplateImportData,
            'Data Kelompok' => new DataPelatihanKelompok,
        );
    }
}
