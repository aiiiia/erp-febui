<?php

namespace App\Http\Controllers\MasterData\Pekerjaan;

use App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\DownloadDataPekerjaanKelompok;
use App\Exports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\TemplateImportPekerjaanKelompok;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiPekerjaan\PekerjaanKelompok\ProcessImportPekerjaanKelompok;
use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaanKelompok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PekerjaanKelompokController extends Controller
{
    public function index()
    {
        return view("master-data.pekerjaan.pekerjaan-kelompok.index");
    }

    public function dataTablePekerjaanKelompok()
    {
        $data = RefPekerjaanKelompok::whereNull('deleted_at')
                        ->get([
                                'id',
                                'nama',
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataPekerjaanKelompokCreate = [
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterPekerjaanKelompok = RefPekerjaanKelompok::create($dataPekerjaanKelompokCreate);

        return redirect()->route('masterDataPekerjaanKelompok.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Kelompok Pekerjaan Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $pekerjaan_kelompok = RefPekerjaanKelompok::find($request->id_value);

        if (!$pekerjaan_kelompok) {
            $message = "failed";
            $code    = 400;
        }

        $pekerjaan_kelompok->nama = $request->nama;
        $pekerjaan_kelompok->updated_at = date('Y-m-d H:i:s');
        $pekerjaan_kelompok->updated_by = auth()->user()->username;

        $pekerjaan_kelompok->save();

        return redirect()->route('masterDataPekerjaanKelompok.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Kelompok Pekerjaan Berhasil Dilakukan",
        ]);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $pekerjaan_kelompok = false;

        $pekerjaan_kelompok = RefPekerjaanKelompok::find($id);

        if (!$pekerjaan_kelompok) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pekerjaan_kelompok,
        );
        return response()->json($data, $code);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $pekerjaan_kelompok = RefPekerjaanKelompok::find($id);

        $pekerjaan_kelompok->delete();

        if (!$pekerjaan_kelompok) {
            $code     = 400;
            $message  = 'failed';
            $pekerjaan_kelompok = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pekerjaan_kelompok,
        );

        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPekerjaanKelompok(), 'Data Pekerjaan Kelompok.xlsx');
    }

    public function template_import()
    {
        return Excel::download(new TemplateImportPekerjaanKelompok, 'Template Import Pekerjaan Kelompok.xlsx');
    }

    public function import_pekerjaan_kelompok(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            Excel::import(new ProcessImportPekerjaanKelompok, $request->file);

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
