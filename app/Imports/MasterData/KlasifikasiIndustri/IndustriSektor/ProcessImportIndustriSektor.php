<?php

namespace App\Imports\MasterData\KlasifikasiIndustri\IndustriSektor;

use App\Imports\MasterData\KlasifikasiIndustri\IndustriSektor\IndustriSektorImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportIndustriSektor implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new IndustriSektorImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
