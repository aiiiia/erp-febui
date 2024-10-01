<?php

namespace App\Imports\MasterData\KlasifikasiPekerjaan\Pekerjaan;

use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class PekerjaanImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.kode' => 'required|string',
            '*.id_kelompok' => 'required|numeric',
            '*.nama' => 'required|string'
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
            '*.kode' => 'Kode',
            '*.id_kelompok' => 'Id Kelompok',
            '*.nama' => 'Nama',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Pekerjaan' &&
            $data_import['kode'] == 'Contoh Kode Kelompok' &&
            $data_import['id_kelompok'] == 'Contoh ID Kelompok Pekerjaan' &&
            $data_import['nama'] == 'Contoh Nama Pekerjaan'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $industri = RefPekerjaan::find($value['id']);

            if ($industri) {
                $industri->kode         = $value['kode'];
                $industri->id_kelompok    = $value['id_kelompok'];
                $industri->nama         = $value['nama'];
                $industri->updated_at   = date('Y-m-d H:i:s');
                $industri->updated_by   = auth()->user()->username;

                $industri->save();
            }else{
                RefPekerjaan::create([
                    'kode' => $value['kode'],
                    'id_kelompok' => $value['id_kelompok'],
                    'nama' => $value['nama'],
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
