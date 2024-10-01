<?php

namespace App\Exports\MasterData\Klien\Client;

use App\Exports\MasterData\Klien\Client\ElementTemplate\TemplateImportData;
use App\Exports\MasterData\Klien\ClientJenis\ElementTemplate\DataClientJenis;
use App\Exports\MasterData\Klien\ClientLokasi\ElementTemplate\DataClientLokasi;
use App\Exports\MasterData\Klien\ClientSumberDana\ElementTemplate\DataClientSumberDana;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TemplateImportClient implements WithMultipleSheets
{
    public function sheets(): array
    {
        return array(
            'Template Import Client' => new TemplateImportData,
            'Data Jenis Client' => new DataClientJenis,
            'Data Lokasi' => new DataClientLokasi,
            'Data Sumber Dana' => new DataClientSumberDana,
        );
    }
}
