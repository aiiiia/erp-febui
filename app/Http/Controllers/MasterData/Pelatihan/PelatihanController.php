<?php

namespace App\Http\Controllers\MasterData\Pelatihan;

use App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\DownloadDataPelatihan;
use App\Exports\MasterData\KlasifikasiPelatihan\Pelatihan\TemplateImportPelatihan;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiPelatihan\Pelatihan\ProcessImportPelatihan;
use App\Models\MasterData\KlasifikasiPelatihan\RefPelatihan;
use App\Models\MasterData\KlasifikasiPelatihan\RefPelatihanKelompok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PelatihanController extends Controller
{
    public function index()
    {
        $kelompok = RefPelatihanKelompok::all();

        return view("master-data.pelatihan.pelatihan.index", compact('kelompok'));
    }

    public function dataTablePelatihan()
    {
        $data = RefPelatihan::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'id_kelompok',
                                'nama'
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('id_kelompok', function($data) {
                $kelompok = RefPelatihanKelompok::select('nama')
                                        ->where('id', $data->id_kelompok)
                                        ->first();

                return ''.$kelompok->nama;
            })
            ->rawColumns(['id_kelompok'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataPelatihanCreate = [
                            "kode" => $request->kode,
                            "id_kelompok" => $request->id_kelompok,
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterPelatihan = RefPelatihan::create($dataPelatihanCreate);

        return redirect()->route('masterDataPelatihan.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Pelatihan Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelatihan = RefPelatihan::find($request->id_value);

        if (!$pelatihan) {
            $message = "failed";
            $code    = 400;
        }

        $pelatihan->kode = $request->kode;
        $pelatihan->id_kelompok = $request->id_kelompok;
        $pelatihan->nama = $request->nama;
        $pelatihan->updated_at = date('Y-m-d H:i:s');
        $pelatihan->updated_by = auth()->user()->username;

        $pelatihan->save();

        return redirect()->route('masterDataPelatihan.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Pelatihan Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $pelatihan = RefPelatihan::find($id);

        $pelatihan->delete();

        if (!$pelatihan) {
            $code     = 400;
            $message  = 'failed';
            $pelatihan = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pelatihan,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $pelatihan = false;

        $pelatihan = RefPelatihan::with(['getKelompok'])
        ->find($id);

        if (!$pelatihan) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pelatihan,
        );
        return response()->json($data, $code);
    }

    public function export() {
        $kelompok = empty(request('filterKelompok')) ? null : request('filterKelompok');

        return Excel::download(new DownloadDataPelatihan($kelompok), 'Data Pelatihan.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportPelatihan, 'Template Import Pelatihan.xlsx');
    }

    public function import_pelatihan(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportPelatihan, $request->file);

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
