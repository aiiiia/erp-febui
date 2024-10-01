<?php

namespace App\Http\Controllers\MasterData\Pelatihan;

use App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\DownloadDataPelatihanKelompok;
use App\Exports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\TemplateImportPelatihanKelompok;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiPelatihan\PelatihanKelompok\ProcessImportPelatihanKelompok;
use App\Models\MasterData\KlasifikasiPelatihan\RefPelatihanKelompok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PelatihanKelompokController extends Controller
{
    public function index()
    {
        return view("master-data.pelatihan.pelatihan-kelompok.index");
    }

    public function dataTablePelatihanKelompok()
    {
        $data = RefPelatihanKelompok::whereNull('deleted_at')
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
        $dataPelatihanKelompokCreate = [
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterPelatihanKelompok = RefPelatihanKelompok::create($dataPelatihanKelompokCreate);

        return redirect()->route('masterDataPelatihanKelompok.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Kelompok Pelatihan Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelatihan_kelompok = RefPelatihanKelompok::find($request->id_value);

        if (!$pelatihan_kelompok) {
            $message = "failed";
            $code    = 400;
        }

        $pelatihan_kelompok->nama = $request->nama;
        $pelatihan_kelompok->updated_at = date('Y-m-d H:i:s');
        $pelatihan_kelompok->updated_by = auth()->user()->username;

        $pelatihan_kelompok->save();

        return redirect()->route('masterDataPelatihanKelompok.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Kelompok Pelatihan Berhasil Dilakukan",
        ]);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $pelatihan_kelompok = false;

        $pelatihan_kelompok = RefPelatihanKelompok::find($id);

        if (!$pelatihan_kelompok) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pelatihan_kelompok,
        );
        return response()->json($data, $code);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $pelatihan_kelompok = RefPelatihanKelompok::find($id);

        $pelatihan_kelompok->delete();

        if (!$pelatihan_kelompok) {
            $code     = 400;
            $message  = 'failed';
            $pelatihan_kelompok = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pelatihan_kelompok,
        );

        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPelatihanKelompok(), 'Data Pelatihan Kelompok.xlsx');
    }

    public function template_import()
    {
        return Excel::download(new TemplateImportPelatihanKelompok, 'Template Import Pelatihan Kelompok.xlsx');
    }

    public function import_pelatihan_kelompok(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            Excel::import(new ProcessImportPelatihanKelompok, $request->file);

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
