<?php

namespace App\Imports\PositionLevel;

use App\Imports\PositionLevel\PositionLevelImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProcessImportPositionLevel implements WithMultipleSheets, SkipsUnknownSheets
{
    public function sheets(): array
    {
        return [
            0 => new PositionLevelImport,
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
