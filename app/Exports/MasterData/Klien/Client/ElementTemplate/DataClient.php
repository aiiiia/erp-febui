<?php

namespace App\Exports\MasterData\Klien\Client\ElementTemplate;

use App\Models\MasterData\Klien\RefClient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataClient implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $Client;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Client';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Client = $this->Client;

        return RefClient::select([
                                    'ref_client.initial',
                                    'ref_client.nama',
                                    'ref_client_jenis.nama',
                                    'ref_client_lokasi.nama',
                                    'ref_client_summber_dana.nama',
                                    'ref_client.alamat',
                                    'ref_client.no_hp',
                                    'ref_client.no_npwp',
                                    'ref_client.status_wapu',
                                ])
                                ->join('ref_client_jenis', 'ref_client_jenis.id', 'client.id_jenis')
                                ->join('ref_client_lokasi', 'ref_client_lokasi.id', 'client.id_lokasi')
                                ->join('ref_client_sumber_dana', 'ref_client_sumber_dana.id', 'client.id_sumber_dana')
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "Initial",
            "Nama",
            "Alamat",
            "ID Lokasi",
            "No Telepon",
            "ID Jenis",
            "ID Sumber Dana",
            "No NPWP",
            "Status Wapu",
        ];
    }

    // * Styling Cell
    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "i") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }
}
