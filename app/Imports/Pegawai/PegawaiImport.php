<?php

namespace App\Imports\Pegawai;

use App\Models\RefPegawai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class PegawaiImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.nip' => 'required',
            '*.nama' => 'required|string',
            '*.job_title' => 'required|string',
            '*.code_position' => 'required|string',
            '*.bod_type' => 'required|string',
            '*.tempat_lahir' => 'required|string',
            '*.alamat' => 'required|string',
            '*.no_ktp' => 'required',
            '*.no_npwp' => 'required',
            '*.email' => 'required|string',
            '*.no_hp' => 'required',
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
            '*.nip' => 'NIP',
            '*.nama' => 'Nama',
            '*.job_title' => 'Job Title',
            '*.code_position' => 'Code Position',
            '*.bod_type' => 'BOD Type',
            '*.tempat_lahir' => 'Tempat Lahir',
            '*.alamat' => 'Alamat',
            '*.no_ktp' => 'No KTP',
            '*.no_npwp' => 'No NPWP',
            '*.email' => 'email',
            '*.no_hp' => 'No HP',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['nip'] == 'Contoh NIP' &&
            $data_import['nama'] == 'Contoh Nama' &&
            $data_import['job_title'] == 'Contoh Job Title' &&
            $data_import['code_position'] == 'Contoh Code Position' &&
            $data_import['bod_type'] == 'Contoh BOD Type' &&
            $data_import['tempat_lahir'] == 'Contoh Tempat Lahir' &&
            $data_import['alamat'] == 'Contoh Alamat' &&
            $data_import['no_ktp'] == 'Contoh No KTP' &&
            $data_import['no_npwp'] == 'Contoh No NPWP' &&
            $data_import['email'] == 'Contoh email' &&
            $data_import['no_hp'] == 'Contoh No HP'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            RefPegawai::updateOrCreate(
                [
                    'nip' => $value['nip'],
                ],
                [
                    'nip' => $value['nip'],
                    'nama' => $value['nama'],
                    'job_title' => $value['job_title'],
                    'code_position' => $value['code_position'],
                    'bod_type' => $value['bod_type'],
                    'tempat_lahir' => $value['tempat_lahir'],
                    'no_ktp' => $value['no_ktp'],
                    'no_npwp' => $value['no_npwp'],
                    'email' => $value['email'],
                    'no_hp' => $value['no_hp'],
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->username
                ]
            );
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
    }
}
