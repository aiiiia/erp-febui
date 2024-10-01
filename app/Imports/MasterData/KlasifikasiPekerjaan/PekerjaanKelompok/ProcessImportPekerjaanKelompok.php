<?php

namespace App\Imports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok;

use App\Imports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\PekerjaanKelompokImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPekerjaanKelompok implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PekerjaanKelompokImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
