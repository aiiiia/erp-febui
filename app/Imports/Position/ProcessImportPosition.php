<?php

namespace App\Imports\Position;

use App\Imports\Position\PositionImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPosition implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PositionImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
