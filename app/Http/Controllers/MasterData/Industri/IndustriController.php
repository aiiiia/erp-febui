<?php

namespace App\Http\Controllers\MasterData\Industri;

use App\Exports\MasterData\KlasifikasiIndustri\Industri\DownloadDataIndustri;
use App\Exports\MasterData\KlasifikasiIndustri\Industri\TemplateImportIndustri;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiIndustri\Industri\ProcessImportIndustri;
use App\Models\MasterData\KlasifikasiIndustri\RefIndustri;
use App\Models\MasterData\KlasifikasiIndustri\RefIndustriSektor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class IndustriController extends Controller
{
    public function index()
    {
        $sektor = RefIndustriSektor::all();

        return view("master-data.industri.industri.index", compact('sektor'));
    }

    public function dataTableIndustri()
    {
        $data = RefIndustri::whereNull('deleted_at')
                        ->get([
                                'id',
                                'kode',
                                'id_sektor',
                                'nama'
                            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('id_sektor', function($data) {
                $sektor = RefIndustriSektor::select('nama')
                                        ->where('id', $data->id_sektor)
                                        ->first();

                return ''.$sektor->nama;
            })
            ->rawColumns(['id_sektor'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataIndustriCreate = [
                            "kode" => $request->kode,
                            "id_sektor" => $request->id_sektor,
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterIndustri = RefIndustri::create($dataIndustriCreate);

        return redirect()->route('masterDataIndustri.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Industri Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $industri = RefIndustri::find($request->id_value);

        if (!$industri) {
            $message = "failed";
            $code    = 400;
        }

        $industri->kode = $request->kode;
        $industri->id_sektor = $request->id_sektor;
        $industri->nama = $request->nama;
        $industri->updated_at = date('Y-m-d H:i:s');
        $industri->updated_by = auth()->user()->username;

        $industri->save();

        return redirect()->route('masterDataIndustri.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Industri Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $industri = RefIndustri::find($id);

        $industri->delete();

        if (!$industri) {
            $code     = 400;
            $message  = 'failed';
            $industri = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $industri,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $industri = false;

        $industri = RefIndustri::with(['getSektor'])
        ->find($id);

        if (!$industri) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $industri,
        );
        return response()->json($data, $code);
    }

    public function export() {
        $sektor = empty(request('filterSektor')) ? null : request('filterSektor');

        return Excel::download(new DownloadDataIndustri($sektor), 'Data Industri.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportIndustri, 'Template Import Industri.xlsx');
    }

    public function import_industri(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportIndustri, $request->file);

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
