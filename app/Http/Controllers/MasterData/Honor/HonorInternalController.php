<?php

namespace App\Http\Controllers\MasterData\Honor;

use App\Exports\MasterData\Honor\HonorInternal\DownloadDataHonorInternal;
use App\Exports\MasterData\Honor\HonorInternal\TemplateImportHonorInternal;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Honor\HonorInternal\ProcessImportHonorInternal;
use App\Models\MasterData\Honor\RefHonorInternal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HonorInternalController extends Controller
{
    public function index()
    {
        return view("master-data.honor.honor-internal.index");
    }

    public function dataTableHonorInternal()
    {
        $data = RefHonorInternal::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'jenis',
                                'honor'
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataHonorInternalCreate = [
                            "kode" => $request->kode,
                            "jenis" => $request->jenis,
                            "honor" => $request->honor,
                            "keterangan" => $request->keterangan,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterHonorInternal = RefHonorInternal::create($dataHonorInternalCreate);

        return redirect()->route('masterDataHonorInternal.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Jenis Honor Internal Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $honor_internal = RefHonorInternal::find($request->id_value);

        if (!$honor_internal) {
            $message = "failed";
            $code    = 400;
        }

        $honor_internal->kode = $request->kode;
        $honor_internal->jenis = $request->jenis;
        $honor_internal->honor = $request->honor;
        $honor_internal->updated_at = date('Y-m-d H:i:s');
        $honor_internal->updated_by = auth()->user()->username;

        $honor_internal->save();

        return redirect()->route('masterDataHonorInternal.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Jenis Honor Internal Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $honor_internal = RefHonorInternal::find($id);

        $honor_internal->delete();

        if (!$honor_internal) {
            $code     = 400;
            $message  = 'failed';
            $honor_internal = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_internal,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $honor_internal = false;

        $honor_internal = RefHonorInternal::find($id);

        if (!$honor_internal) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_internal,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataHonorInternal(), 'Data Jenis Honor Internal.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportHonorInternal, 'Template Import Jenis Honor Internal.xlsx');
    }

    public function import_honor_internal(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportHonorInternal, $request->file);

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
