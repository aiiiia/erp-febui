<?php

namespace App\Imports\MasterData\KlasifikasiPekerjaan\Pekerjaan;

use App\Imports\MasterData\KlasifikasiPekerjaan\Pekerjaan\PekerjaanImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPekerjaan implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PekerjaanImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
