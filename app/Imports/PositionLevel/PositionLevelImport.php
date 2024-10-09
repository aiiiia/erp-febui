<?php

namespace App\Imports\PositionLevel;

use App\Models\RefPositionLevel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class PositionLevelImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.code_position_level' => 'required|string',
            '*.nama_position_level' => 'required|string',
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
            '*.code_position_level' => 'Code PositionLevel',
            '*.nama_position_level' => 'Nama PositionLevel',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Position Level' &&
            $data_import['code_position_level'] == 'Contoh Code Position Level' &&
            $data_import['nama_position_level'] == 'Contoh Nama Position Level'

        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $client = RefPositionLevel::find($value['id']);

            if ($client) {
                $client->code_position_level    = $value['code_position_level'];
                $client->nama_position_level    = $value['nama_position_level'];
                $client->updated_at     = date('Y-m-d H:i:s');
                $client->created_by     = auth()->user()->username;

                $client->save();
            }else{
                RefPositionLevel::create([
                    'code_position_level'      => $value['code_position_level'],
                    'nama_position_level'      => $value['nama_position_level'],
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
