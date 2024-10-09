<?php

namespace App\Imports\Unit;

use App\Imports\Unit\UnitImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportUnit implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new UnitImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
