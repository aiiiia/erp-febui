<?php

namespace App\Http\Controllers\MasterData\Pekerjaan;

use App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan\DownloadDataPekerjaan;
use App\Exports\MasterData\KlasifikasiPekerjaan\Pekerjaan\TemplateImportPekerjaan;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiPekerjaan\Pekerjaan\ProcessImportPekerjaan;
use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaan;
use App\Models\MasterData\KlasifikasiPekerjaan\RefPekerjaanKelompok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PekerjaanController extends Controller
{
    public function index()
    {
        $kelompok = RefPekerjaanKelompok::all();

        return view("master-data.pekerjaan.pekerjaan.index", compact('kelompok'));
    }

    public function dataTablePekerjaan()
    {
        $data = RefPekerjaan::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'id_kelompok',
                                'nama'
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('id_kelompok', function($data) {
                $kelompok = RefPekerjaanKelompok::select('nama')
                                        ->where('id', $data->id_kelompok)
                                        ->first();

                return ''.$kelompok->nama;
            })
            ->rawColumns(['id_kelompok'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataPekerjaanCreate = [
                            "kode" => $request->kode,
                            "id_kelompok" => $request->id_kelompok,
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterPekerjaan = RefPekerjaan::create($dataPekerjaanCreate);

        return redirect()->route('masterDataPekerjaan.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Pekerjaan Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = RefPekerjaan::find($request->id_value);

        if (!$pekerjaan) {
            $message = "failed";
            $code    = 400;
        }

        $pekerjaan->kode = $request->kode;
        $pekerjaan->id_kelompok = $request->id_kelompok;
        $pekerjaan->nama = $request->nama;
        $pekerjaan->updated_at = date('Y-m-d H:i:s');
        $pekerjaan->updated_by = auth()->user()->username;

        $pekerjaan->save();

        return redirect()->route('masterDataPekerjaan.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Pekerjaan Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $pekerjaan = RefPekerjaan::find($id);

        $pekerjaan->delete();

        if (!$pekerjaan) {
            $code     = 400;
            $message  = 'failed';
            $pekerjaan = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pekerjaan,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $pekerjaan = false;

        $pekerjaan = RefPekerjaan::with(['getKelompok'])
        ->find($id);

        if (!$pekerjaan) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pekerjaan,
        );
        return response()->json($data, $code);
    }

    public function export() {
        $kelompok = empty(request('filterKelompok')) ? null : request('filterKelompok');

        return Excel::download(new DownloadDataPekerjaan($kelompok), 'Data Pekerjaan.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportPekerjaan, 'Template Import Pekerjaan.xlsx');
    }

    public function import_pekerjaan(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportPekerjaan, $request->file);

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
