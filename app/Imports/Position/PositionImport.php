<?php

namespace App\Imports\Position;

use App\Models\RefPosition;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class PositionImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.id' => 'nullable|numeric',
            '*.code_position_level' => 'required|string',
            '*.code_position_type' => 'required|string',
            '*.code_unit' => 'required|string',
            '*.code_position' => 'required|string',
            '*.nama_position' => 'required|string',
            '*.org_level' => 'required|string',
            '*.line_manager' => 'required|string',
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
            '*.code_position_level' => 'Code Position Level',
            '*.code_position_type' => 'Code Position Type',
            '*.code_unit' => 'Code Unit',
            '*.code_position' => 'Code Position',
            '*.nama_position' => 'Nama Position',
            '*.org_level' => 'Org Level',
            '*.line_manager' => 'Line Manager',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Position' &&
            $data_import['code_position_level'] == 'Contoh Code Position Level' &&
            $data_import['code_position_type'] == 'Contoh Code Position Type' &&
            $data_import['code_unit'] == 'Contoh Code Unit' &&
            $data_import['code_position'] == 'Contoh Code Position' &&
            $data_import['nama_position'] == 'Contoh Nama Position' &&
            $data_import['org_level'] == 'Contoh Org Level' &&
            $data_import['line_manager'] == 'Contoh Line Manager'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $client = RefPosition::find($value['id']);

            if ($client) {
                $client->code_position_level       = $value['code_position_level'];
                $client->code_position_type        = $value['code_position_type'];
                $client->code_unit                 = $value['code_unit'];
                $client->code_position             = $value['code_position'];
                $client->nama_position             = $value['nama_position'];
                $client->org_level                 = $value['org_level'];
                $client->line_manager              = $value['line_manager'];
                $client->updated_at                = date('Y-m-d H:i:s');
                $client->updated_by                = auth()->user()->username;

                $client->save();
            }else{
                RefPosition::create([
                    'code_position_level' => $value['code_position_level'],
                    'code_position_type' => $value['code_position_type'],
                    'code_unit' => $value['code_unit'],
                    'code_position' => $value['code_position'],
                    'nama_position' => $value['nama_position'],
                    'org_level' => $value['org_level'],
                    'line_manager' => $value['line_manager'],
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
