<?php

namespace App\Imports\MasterData\KlasifikasiIndustri\Industri;

use App\Models\MasterData\KlasifikasiIndustri\RefIndustri;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class IndustriImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.kode' => 'required|string',
            '*.id_sektor' => 'required|numeric',
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
            '*.id_sektor' => 'Id Sektor',
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
            $data_import['id'] == 'Contoh ID Industri' &&
            $data_import['kode'] == 'Contoh Kode Sektor' &&
            $data_import['id_sektor'] == 'Contoh ID Sektor Industri' &&
            $data_import['nama'] == 'Contoh Nama Industri'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $industri = RefIndustri::find($value['id']);

            if ($industri) {
                $industri->kode         = $value['kode'];
                $industri->id_sektor    = $value['id_sektor'];
                $industri->nama         = $value['nama'];
                $industri->updated_at   = date('Y-m-d H:i:s');
                $industri->updated_by   = auth()->user()->username;

                $industri->save();
            }else{
                RefIndustri::create([
                    'kode' => $value['kode'],
                    'id_sektor' => $value['id_sektor'],
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
