<?php

namespace App\Http\Controllers\MasterData\Klien;

use App\Exports\MasterData\Klien\ClientSumberDana\DownloadDataClientSumberDana;
use App\Exports\MasterData\Klien\ClientSumberDana\TemplateImportClientSumberDana;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Klien\ClientSumberDana\ProcessImportClientSumberDana;
use App\Models\MasterData\Klien\RefClientSumberDana;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ClientSumberDanaController extends Controller
{

    public function index()
    {

        return view("master-data.klien.client-sumber-dana.index");
    }

    public function dataTableClientSumberDana()
    {
        $data = RefClientSumberDana::whereNull('deleted_at')->get([
                    'id',
                    'nama',
                ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataClientSumberDanaCreate = [
                                "nama"           => $request->nama,
                                "created_at"     => date('Y-m-d H:i:s'),
                                "created_by"     => auth()->user()->username
                            ];

        $masterClientSumberDana = RefClientSumberDana::create($dataClientSumberDanaCreate);

        return redirect()->route('masterDataClientSumberDana.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Sumber Dana Client Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $client_sumber_dana = RefClientSumberDana::find($request->id_value);

        if (!$client_sumber_dana) {
            $message = "failed";
            $code    = 400;
        }

        $client_sumber_dana->nama           = $request->nama;
        $client_sumber_dana->updated_at     = date('Y-m-d H:i:s');
        $client_sumber_dana->updated_by     = auth()->user()->username;

        $client_sumber_dana->save();

        return redirect()->route('masterDataClientSumberDana.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data SumberDana Client Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $client_sumber_dana = RefClientSumberDana::find($id);

        $client_sumber_dana->delete();

        if (!$client_sumber_dana) {
            $code     = 400;
            $message  = 'failed';
            $client_sumber_dana = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_sumber_dana,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $client_sumber_dana = false;

        $client_sumber_dana = RefClientSumberDana::find($id);

        if (!$client_sumber_dana) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client_sumber_dana,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataClientSumberDana(), 'Data SumberDana Client.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportClientSumberDana, 'Template Import SumberDana Client.xlsx');
    }

    public function import_client_sumber_dana(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportClientSumberDana, $request->file);

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
