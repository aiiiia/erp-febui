<?php

namespace App\Exports\Pegawai\ElementTemplate;

use App\Models\RefPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPegawai implements FromCollection, WithTitle, WithStyles, WithHeadings, ShouldAutoSize
{
    private $Pegawai;
    public function __construct()
    {
        //
    }

    public function title(): string
    {
        return 'Data Pegawai';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Pegawai = $this->Pegawai;

        return RefPegawai::select([
                                    'ref_pegawai.nip',
                                    'ref_pegawai.nama',
                                    'ref_position.nama_position',
                                    'ref_position_level.nama_position_level',
                                    'ref_pegawai.status_karyawan',
                                    'ref_pegawai.jenis_kelamin',
                                    'ref_pegawai.tempat_lahir',
                                    'ref_pegawai.tgl_lahir',
                                    'ref_pegawai.agama',
                                    'ref_pegawai.marst',
                                    'ref_pegawai.alamat',
                                    'ref_pegawai.no_ktp',
                                    'ref_pegawai.no_npwp',
                                    'ref_pegawai.email',
                                    'ref_pegawai.no_hp',
                                ])
                                ->join('ref_position_level', 'ref_position_level.code_position_level', 'ref_position.code_position_level')
                                ->join('ref_position_type', 'ref_position_type.code_position_type', 'ref_position.code_position_type')
                                ->get();
    }

    // * Heading Sheet
    public function headings(): array
    {
        return [
            "NIP Pegawai",
            "Nama Pegawai",
            "Position Pegawai",
            "Position Level",
            "Status Karyawan",
            "Jenis Kelamin",
            "Tempat Lahir",
            "Tgl Lahir",
            "Agama",
            "Status Pernikahan",
            "Alamat",
            "No KTP",
            "No NPWP",
            "email",
            "No HP",
        ];
    }

    // * Styling Cell
    public function styles(Worksheet $sheet)
    {
        foreach (range("a", "o") as $value) {
            $cell = strtoupper($value)."1";
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
    }
}
