<?php

namespace App\Http\Controllers\MasterData\Klien;

use App\Exports\MasterData\Klien\Client\DownloadDataClient;
use App\Exports\MasterData\Klien\Client\TemplateImportClient;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\Klien\Client\ProcessImportClient;
use App\Models\MasterData\Klien\RefClient;
use App\Models\MasterData\Klien\RefClientJenis;
use App\Models\MasterData\Klien\RefClientLokasi;
use App\Models\MasterData\Klien\RefClientSumberDana;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ClientController extends Controller
{

    public function index()
    {
        $client_jenis       = RefClientJenis::all();
        $client_lokasi      = RefClientLokasi::all();
        $client_sumber_dana = RefClientSumberDana::all();

        return view("master-data.klien.client.index", compact('client_jenis', 'client_lokasi', 'client_sumber_dana'));
    }

    public function dataTableClient()
    {
        $data = RefClient::orderBy('initial')->get([
                    'id',
                    'id_jenis',
                    'id_lokasi',
                    'id_sumber_dana',
                    'nama',
                    'alamat',
                    'no_hp',
                    'no_npwp',
                    'status_wapu',
                    'initial',
                ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('id_jenis', function($data) {
                $client_jenis = RefClientJenis::select('nama')
                                        ->where('id', $data->id_jenis)
                                        ->first();

                return ''.$client_jenis->nama;
            })
            ->editColumn('id_lokasi', function($data) {
                $client_lokasi = RefClientLokasi::select('nama')
                                        ->where('id', $data->id_lokasi)
                                        ->first();

                return ''.$client_lokasi->nama;
            })
            ->editColumn('id_sumber_dana', function($data) {
                $client_sumber_dana = RefClientSumberDana::select('nama')
                                        ->where('id', $data->id_sumber_dana)
                                        ->first();

                return ''.$client_sumber_dana->nama;
            })
            ->editColumn('status_wapau', function($data) {
                if($data->status_wapu == 0){
                    return 'Tidak';
                }else{
                    return 'Ya';
                }
            })
            ->rawColumns(['id_jenis', 'id_lokasi', 'id_sumber_dana'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataClientCreate = [
                                "id_jenis"       => $request->id_jenis,
                                "id_lokasi"      => $request->id_lokasi,
                                "id_sumber_dana" => $request->id_sumber_dana,
                                "nama"           => $request->nama,
                                "alamat"         => $request->alamat,
                                "no_hp"          => $request->no_hp,
                                "no_npwp"        => $request->no_npwp,
                                "status_wapu"    => $request->status_wapu,
                                "intial"         => $request->initial,
                                "created_at"     => date('Y-m-d H:i:s'),
                                "created_by"     => auth()->user()->username
                            ];

        $masterClient = RefClient::create($dataClientCreate);

        return redirect()->route('masterDataClient.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Client Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = RefClient::find($request->id_value);

        if (!$client) {
            $message = "failed";
            $code    = 400;
        }

        $client->id_jenis       = $request->id_jenis;
        $client->id_lokasi      = $request->id_lokasi;
        $client->id_sumber_dana = $request->id_sumber_dana;
        $client->nama           = $request->nama;
        $client->alamat         = $request->alamat;
        $client->no_hp          = $request->no_hp;
        $client->no_npwp        = $request->no_npwp;
        $client->status_wapu    = $request->status_wapu;
        $client->initial        = $request->initial;
        $client->updated_at     = date('Y-m-d H:i:s');
        $client->updated_by     = auth()->user()->username;

        $client->save();

        return redirect()->route('masterDataClient.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Client Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $client = RefClient::find($id);

        $client->delete();

        if (!$client) {
            $code     = 400;
            $message  = 'failed';
            $client = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $client = false;

        $client = RefClient::with(['getClientJenis', 'getClientLokasi', 'getClientSumberDana'])
                                ->find($id);

        if (!$client) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $client,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataClient(), 'Data Client.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportClient, 'Template Import Client.xlsx');
    }

    public function import_client(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportClient, $request->file);

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
