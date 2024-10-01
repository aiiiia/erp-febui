<?php

namespace App\Imports\MasterData\Klien\Client;

use App\Models\MasterData\Klien\RefClient;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class ClientImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.id_jenis' => 'required|numeric',
            '*.id_lokasi' => 'required|numeric',
            '*.id_sumber_dana' => 'required|numeric',
            '*.nama' => 'required|string',
            '*.alamat' => 'required|string',
            '*.no_hp' => 'required|string',
            '*.no_npwp' => 'required|string',
            '*.status_wapu' => 'required|string',
            '*.initial' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'required' => 'The :attribute field is required <br>',
            'string' => 'The :attribute field just character with A-Z or a-z',
            'numeric' => 'The :attribute field just number with 0-9',
        ];
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            '*.id' => 'Id',
            '*.id_jenis' => 'ID Jenis',
            '*.id_lokasi' => 'ID Lokasi',
            '*.id_sumber_dana' => 'ID Sumber Dana',
            '*.nama' => 'Nama',
            '*.alamat' => 'Alamat',
            '*.no_hp' => 'No Telepon',
            '*.no_npwp' => 'No NPWP',
            '*.status_wapu' => 'Status Wapu',
            '*.initial' => 'Initial'
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Client' &&
            $data_import['id_jenis'] == 'Contoh Jenis Instansi' &&
            $data_import['id_lokasi'] == 'Contoh Lokasi Client' &&
            $data_import['id_sumber_dana'] == 'Contoh ID Sektor Client' &&
            $data_import['initial'] == 'Contoh Initial Client' &&
            $data_import['nama'] == 'Contoh Nama Client' &&
            $data_import['alamat'] == 'Contoh Alamat Client' &&
            $data_import['no_hp'] == 'Contoh No Telepon' &&
            $data_import['no_npwp'] == 'Contoh No NPWP' &&
            $data_import['status_wapu'] == 'Contoh Status Wapu'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $client = RefClient::find($value['id']);

            if ($client) {
                $client->id_jenis       = $value['id_jenis'];
                $client->id_lokasi      = $value['id_lokasi'];
                $client->id_sumber_dana = $value['id_sumber_dana'];
                $client->initial        = $value['initial'];
                $client->nama           = $value['nama'];
                $client->alamat         = $value['alamat'];
                $client->no_hp          = $value['no_hp'];
                $client->no_npwp        = $value['no_npwp'];
                $client->status_wapu    = $value['status_wapu'];
                $client->updated_at     = date('Y-m-d H:i:s');
                $client->updated_by     = auth()->user()->username;

                $client->save();
            }else{
                RefClient::create([
                    'id_jenis'       => $value['id_jenis'],
                    'id_lokasi'      => $value['id_lokasi'],
                    'id_sumber_dana' => $value['id_sumber_dana'],
                    'nama' => $value['nama'],
                    'alamat' => $value['alamat'],
                    'no_hp' => $value['no_hp'],
                    'no_npwp' => $value['no_npwp'],
                    'status_wapu' => $value['status_wapu'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->username
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
        //
    }
}
