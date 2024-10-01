<?php

namespace App\Imports\MasterData\KlasifikasiPelatihan\Pelatihan;

use App\Imports\MasterData\KlasifikasiPelatihan\Pelatihan\PelatihanImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPelatihan implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PelatihanImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
