<?php

namespace App\Imports\Unit;

use App\Models\RefUnit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class UnitImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.code_unit' => 'required|string',
            '*.nama_unit' => 'required|string',
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
            '*.code_unit' => 'Code Unit',
            '*.nama_unit' => 'Nama Unit',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Unit' &&
            $data_import['code_unit'] == 'Contoh Code Unit' &&
            $data_import['nama_unit'] == 'Contoh Nama Unit'

        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $client = RefUnit::find($value['id']);

            if ($client) {
                $client->code_unit    = $value['code_unit'];
                $client->nama_unit    = $value['nama_unit'];
                $client->updated_at     = date('Y-m-d H:i:s');
                $client->created_by     = auth()->user()->username;

                $client->save();
            }else{
                RefUnit::create([
                    'code_unit'      => $value['code_unit'],
                    'nama_unit'      => $value['nama_unit'],
                    'updated_at'     => date('Y-m-d H:i:s'),
                    'updated_by'     => auth()->user()->username,
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
