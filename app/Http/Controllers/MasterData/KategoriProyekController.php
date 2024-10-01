<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefKategoriProyek;
use Yajra\Datatables\Datatables;

class KategoriProyekController extends Controller
{
    public function index()
    {
        return view("master-data.kategori-proyek.index");
    }

    public function dataTableKategoriProyek()
    {
        $data = RefKategoriProyek::get([
            'id',
            'code_kategori_proyek',
            'nama_kategori_proyek',
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataKategoriProyekCreate = [
                                        "code_kategori_proyek" => $request->code_kategori_proyek,
                                        "nama_kategori_proyek" => $request->nama_kategori_proyek,
                                        "created_at" => date('Y-m-d H:i:s'),
                                        "created_by" => auth()->user()->username
                                    ];

        $masterKategoriProyek = RefKategoriProyek::create($dataKategoriProyekCreate);

        return redirect()->route('masterDataKategoriProyek.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Kategori Proyek Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori_proyek = RefKategoriProyek::find($request->id_value);

        if (!$kategori_proyek) {
            $message = "failed";
            $code    = 400;
        }

        $kategori_proyek->code_kategori_proyek = $request->code_kategori_proyek;
        $kategori_proyek->nama_kategori_proyek = $request->nama_kategori_proyek;
        $kategori_proyek->updated_at = date('Y-m-d H:i:s');
        $kategori_proyek->updated_by = auth()->user()->username;

        $kategori_proyek->save();

        return redirect()->route('masterDataKategoriProyek.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Kategori Proyek Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $kategori_proyek = RefKategoriProyek::find($id);

        $kategori_proyek->delete();

        if (!$kategori_proyek) {
            $code     = 400;
            $message  = 'failed';
            $kategori_proyek = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $kategori_proyek,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $KategoriProyek = false;

        $KategoriProyek = RefKategoriProyek::find($id);

        if (!$KategoriProyek) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $KategoriProyek,
        );
        return response()->json($data, $code);
    }
}
