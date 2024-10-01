<?php

namespace App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan;

use App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan\ElementTemplate\TemplateImportData;
use App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\ElementTemplate\DataPekerjaanKelompok;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportPekerjaan implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Pekerjaan' => new TemplateImportData,
            'Data Kelompok' => new DataPekerjaanKelompok,
        );
    }
}
