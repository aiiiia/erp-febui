<?php

namespace App\Imports\MasterData\KlasifikasiPelatihan\PelatihanKelompok;

use App\Imports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\PelatihanKelompokImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPelatihanKelompok implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PelatihanKelompokImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
