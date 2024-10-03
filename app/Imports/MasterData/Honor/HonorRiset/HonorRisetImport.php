<?php

namespace App\Imports\MasterData\Honor\HonorRiset;

use App\Models\MasterData\Honor\RefHonorRiset;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class HonorRisetImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '*.id' => 'required|numeric',
            '*.kode' => 'required|string',
            '*.jenis' => 'required|string',
            '*.honor' => 'required|numeric',
            '*.satuan' => 'required|string',
            '*.keterangan' => 'required|string'
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
            '*.jenis' => 'Jenis',
            '*.honor' => 'Honor',
            '*.satuan' => 'Satuan',
            '*.keterangan' => 'Keterangan',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $data_import = $collection->toArray()[0];

        if (
            $data_import['id'] == 'Contoh ID Honor Riset' &&
            $data_import['kode'] == 'Contoh Kode Honor Riset' &&
            $data_import['jenis'] == 'Contoh Jenis Honor Riset' &&
            $data_import['honor'] == 'Contoh Honor Honor Riset' &&
            $data_import['satuan'] == 'Contoh Satuan Honor Riset' &&
            $data_import['keterangan'] == 'Contoh Keterangan Honor Riset'
        ) {
            $error = ['Could not import default template'];
            $failures[] = new Failure(0, 'code_member', $error, $data_import);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error), $failures);
        }

        foreach ($collection as $value) {
            $industri = RefHonorRiset::find($value['id']);

            if ($industri) {
                $industri->kode         = $value['kode'];
                $industri->jenis        = $value['jenis'];
                $industri->honor        = $value['honor'];
                $industri->satuan       = $value['satuan'];
                $industri->keterangan   = $value['keterangan'];
                $industri->updated_at   = date('Y-m-d H:i:s');
                $industri->updated_by   = auth()->user()->username;

                $industri->save();
            }else{
                RefHonorRiset::create([
                    'kode' => $value['kode'],
                    'jenis' => $value['jenis'],
                    'honor' => $value['honor'],
                    'satuan' => $value['satuan'],
                    'keterangan' => $value['keterangan'],
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
