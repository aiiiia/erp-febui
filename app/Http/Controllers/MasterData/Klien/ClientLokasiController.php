<?php

namespace App\Http\Controllers\MasterData\Klien;

use App\Exports\MasterData\Klien\ClientLokasi\DownloadDataClientLokasi;
use App\Exports\MasterData\Klien\ClientLokasi\TemplateImportClientLokasi;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Klien\ClientLokasi\ProcessImportClientLokasi;
use App\Models\MasterData\Klien\RefClientLokasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ClientLokasiController extends Controller
{

    public function index()
    {

        return view("master-data.klien.client-lokasi.index");
    }

    public function dataTableClientLokasi()
    {
        $data = RefClientLokasi::whereNull('deleted_at')->get([
                    'id',
                    'nama',
                ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataClientLokasiCreate = [
                                "nama"           => $request->nama,
                                "created_at"     => date('Y-m-d H:i:s'),
                                "created_by"     => auth()->user()->username
                            ];

        $masterClientLokasi = RefClientLokasi::create($dataClientLokasiCreate);

        return redirect()->route('masterDataClientLokasi.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Lokasi Client Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $client_lokasi = RefClientLokasi::find($request->id_value);

        if (!$client_lokasi) {
            $message = "failed";
            $code    = 400;
        }

        $client_lokasi->nama           = $request->nama;
        $client_lokasi->updated_at     = date('Y-m-d H:i:s');
        $client_lokasi->updated_by     = auth()->user()->username;

        $client_lokasi->save();

        return redirect()->route('masterDataClientLokasi.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Lokasi Client Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $client_lokasi = RefClientLokasi::find($id);

        $client_lokasi->delete();

        if (!$client_lokasi) {
            $code     = 400;
            $message  = 'failed';
            $client_lokasi = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_lokasi,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $client_lokasi = false;

        $client_lokasi = RefClientLokasi::find($id);

        if (!$client_lokasi) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_lokasi,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataClientLokasi(), 'Data Lokasi Client.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportClientLokasi, 'Template Import Lokasi Client.xlsx');
    }

    public function import_client_lokasi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportClientLokasi, $request->file);

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
