<?php

namespace App\Http\Controllers\MasterData\Honor;

use App\Exports\MasterData\Honor\HonorRiset\DownloadDataHonorRiset;
use App\Exports\MasterData\Honor\HonorRiset\TemplateImportHonorRiset;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Honor\HonorRiset\ProcessImportHonorRiset;
use App\Models\MasterData\Honor\RefHonorRiset;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HonorRisetController extends Controller
{
    public function index()
    {
        return view("master-data.honor.honor-riset.index");
    }

    public function dataTableHonorRiset()
    {
        $data = RefHonorRiset::whereNull('deleted_at')
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
        $dataHonorRisetCreate = [
                            "kode" => $request->kode,
                            "jenis" => $request->jenis,
                            "honor" => $request->honor,
                            "keterangan" => $request->keterangan,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterHonorRiset = RefHonorRiset::create($dataHonorRisetCreate);

        return redirect()->route('masterDataHonorRiset.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Jenis Honor Pada Div. Riset & Konsultasi Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $honor_riset = RefHonorRiset::find($request->id_value);

        if (!$honor_riset) {
            $message = "failed";
            $code    = 400;
        }

        $honor_riset->kode = $request->kode;
        $honor_riset->jenis = $request->jenis;
        $honor_riset->honor = $request->honor;
        $honor_riset->updated_at = date('Y-m-d H:i:s');
        $honor_riset->updated_by = auth()->user()->username;

        $honor_riset->save();

        return redirect()->route('masterDataHonorRiset.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Jenis Honor Pada Div. Riset & Konsultasi Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $honor_riset = RefHonorRiset::find($id);

        $honor_riset->delete();

        if (!$honor_riset) {
            $code     = 400;
            $message  = 'failed';
            $honor_riset = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_riset,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $honor_riset = false;

        $honor_riset = RefHonorRiset::find($id);

        if (!$honor_riset) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_riset,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataHonorRiset(), 'Data Jenis Honor Div. Riset & Konsultasi.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportHonorRiset, 'Template Import Jenis Honor Div. Riset & Konsultasi.xlsx');
    }

    public function import_honor_riset(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportHonorRiset, $request->file);

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
