<?php

namespace App\Http\Controllers\MasterData\Honor;

use App\Exports\MasterData\Honor\HonorTraining\DownloadDataHonorTraining;
use App\Exports\MasterData\Honor\HonorTraining\TemplateImportHonorTraining;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Honor\HonorTraining\ProcessImportHonorTraining;
use App\Models\MasterData\Honor\RefHonorTraining;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HonorTrainingController extends Controller
{
    public function index()
    {
        return view("master-data.honor.honor-training.index");
    }

    public function dataTableHonorTraining()
    {
        $data = RefHonorTraining::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'jenis',
                                'honor',
                                'satuan',
                                'keterangan',
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataHonorTrainingCreate = [
                            "kode" => $request->kode,
                            "jenis" => $request->jenis,
                            "honor" => $request->honor,
                            "satuan" => $request->satuan,
                            "keterangan" => $request->keterangan,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterHonorTraining = RefHonorTraining::create($dataHonorTrainingCreate);

        return redirect()->route('masterDataHonorTraining.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Jenis Honor Pada Div. Training Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $honor_training = RefHonorTraining::find($request->id_value);

        if (!$honor_training) {
            $message = "failed";
            $code    = 400;
        }

        $honor_training->kode = $request->kode;
        $honor_training->jenis = $request->jenis;
        $honor_training->honor = $request->honor;
        $honor_training->satuan = $request->satuan;
        $honor_training->keterangan = $request->keterangan;
        $honor_training->updated_at = date('Y-m-d H:i:s');
        $honor_training->updated_by = auth()->user()->username;

        $honor_training->save();

        return redirect()->route('masterDataHonorTraining.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Jenis Honor Pada Div. Training Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $honor_training = RefHonorTraining::find($id);

        $honor_training->delete();

        if (!$honor_training) {
            $code     = 400;
            $message  = 'failed';
            $honor_training = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_training,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $honor_training = false;

        $honor_training = RefHonorTraining::find($id);

        if (!$honor_training) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_training,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataHonorTraining(), 'Data Jenis Honor Div. Training.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportHonorTraining, 'Template Import Jenis Honor Div. Training.xlsx');
    }

    public function import_honor_training(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportHonorTraining, $request->file);

            return redirect()->back()->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "File has been import",
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }

            return redirect()->back()->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Error: ".$failure->values()." has ".$failure->values(),
            ]);
       }
    }
}
