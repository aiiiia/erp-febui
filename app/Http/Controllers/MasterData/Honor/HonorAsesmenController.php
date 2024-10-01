<?php

namespace App\Http\Controllers\MasterData\Honor;

use App\Exports\MasterData\Honor\HonorAsesmen\DownloadDataHonorAsesmen;
use App\Exports\MasterData\Honor\HonorAsesmen\TemplateImportHonorAsesmen;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Honor\HonorAsesmen\ProcessImportHonorAsesmen;
use App\Models\MasterData\Honor\RefHonorAsesmen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HonorAsesmenController extends Controller
{
    public function index()
    {
        return view("master-data.honor.honor-asesmen.index");
    }

    public function dataTableHonorAsesmen()
    {
        $data = RefHonorAsesmen::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'jenis',
                                'honor',
                                'satuan',
                                'keterangan'
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataHonorAsesmenCreate = [
                            "kode" => $request->kode,
                            "jenis" => $request->jenis,
                            "honor" => $request->honor,
                            "satuan" => $request->satuan,
                            "keterangan" => $request->keterangan,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterHonorAsesmen = RefHonorAsesmen::create($dataHonorAsesmenCreate);

        return redirect()->route('masterDataHonorAsesmen.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Jenis Honor Pada Div. Asesmen Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $honor_asesmen = RefHonorAsesmen::find($request->id_value);

        if (!$honor_asesmen) {
            $message = "failed";
            $code    = 400;
        }

        $honor_asesmen->kode = $request->kode;
        $honor_asesmen->jenis = $request->jenis;
        $honor_asesmen->honor = $request->honor;
        $honor_asesmen->satuan = $request->satuan;
        $honor_asesmen->keterangan = $request->keterangan;
        $honor_asesmen->updated_at = date('Y-m-d H:i:s');
        $honor_asesmen->updated_by = auth()->user()->username;

        $honor_asesmen->save();

        return redirect()->route('masterDataHonorAsesmen.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Jenis Honor Pada Div. Asesmen Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $honor_asesmen = RefHonorAsesmen::find($id);

        $honor_asesmen->delete();

        if (!$honor_asesmen) {
            $code     = 400;
            $message  = 'failed';
            $honor_asesmen = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_asesmen,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $honor_asesmen = false;

        $honor_asesmen = RefHonorAsesmen::find($id);

        if (!$honor_asesmen) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $honor_asesmen,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataHonorAsesmen(), 'Data Jenis Honor Div. Asesmen.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportHonorAsesmen, 'Template Import Jenis Honor Div. Asesmen.xlsx');
    }

    public function import_honor_asesmen(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportHonorAsesmen, $request->file);

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
