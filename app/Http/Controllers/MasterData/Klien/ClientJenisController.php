<?php

namespace App\Http\Controllers\MasterData\Klien;

use App\Exports\MasterData\Klien\ClientJenis\DownloadDataClientJenis;
use App\Exports\MasterData\Klien\ClientJenis\TemplateImportClientJenis;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Klien\ClientJenis\ProcessImportClientJenis;
use App\Models\MasterData\Klien\RefClientJenis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ClientJenisController extends Controller
{

    public function index()
    {

        return view("master-data.klien.client-jenis.index");
    }

    public function dataTableClientJenis()
    {
        $data = RefClientJenis::whereNull('deleted_at')->get([
                    'id',
                    'nama',
                ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataClientJenisCreate = [
                                "nama"           => $request->nama,
                                "created_at"     => date('Y-m-d H:i:s'),
                                "created_by"     => auth()->user()->username
                            ];

        $masterClientJenis = RefClientJenis::create($dataClientJenisCreate);

        return redirect()->route('masterDataClientJenis.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Jenis Client Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $client_jenis = RefClientJenis::find($request->id_value);

        if (!$client_jenis) {
            $message = "failed";
            $code    = 400;
        }

        $client_jenis->nama           = $request->nama;
        $client_jenis->updated_at     = date('Y-m-d H:i:s');
        $client_jenis->updated_by     = auth()->user()->username;

        $client_jenis->save();

        return redirect()->route('masterDataClientJenis.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Jenis Client Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $client_jenis = RefClientJenis::find($id);

        $client_jenis->delete();

        if (!$client_jenis) {
            $code     = 400;
            $message  = 'failed';
            $client_jenis = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_jenis,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $client_jenis = false;

        $client_jenis = RefClientJenis::find($id);

        if (!$client_jenis) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_jenis,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataClientJenis(), 'Data Jenis Client.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportClientJenis, 'Template Import Jenis Client.xlsx');
    }

    public function import_client_jenis(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportClientJenis, $request->file);

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
