<?php

namespace App\Http\Controllers\MasterData\Industri;

use App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\DownloadDataIndustriSektor;
use App\Exports\MasterData\KlasifikasiIndustri\IndustriSektor\TemplateImportIndustriSektor;
use App\Http\Controllers\Controller;
use App\Imports\MasterData\KlasifikasiIndustri\IndustriSektor\ProcessImportIndustriSektor;
use App\Models\MasterData\KlasifikasiIndustri\RefIndustriSektor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class IndustriSektorController extends Controller
{
    public function index()
    {
        return view("master-data.industri.industri-sektor.index");
    }

    public function dataTableIndustriSektor()
    {
        $data = RefIndustriSektor::whereNull('deleted_at')
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
        $dataIndustriSektorCreate = [
                            "nama" => $request->nama,
                            "created_at" => date('Y-m-d H:i:s'),
                            "created_by" => auth()->user()->username
                        ];

        $masterIndustriSektor = RefIndustriSektor::create($dataIndustriSektorCreate);

        return redirect()->route('masterDataIndustriSektor.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Sektor Industri Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $industri_sektor = RefIndustriSektor::find($request->id_value);

        if (!$industri_sektor) {
            $message = "failed";
            $code    = 400;
        }

        $industri_sektor->nama = $request->nama;
        $industri_sektor->updated_at = date('Y-m-d H:i:s');
        $industri_sektor->updated_by = auth()->user()->username;

        $industri_sektor->save();

        return redirect()->route('masterDataIndustriSektor.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Sektor Industri Berhasil Dilakukan",
        ]);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $industriSektor = false;

        $industriSektor = RefIndustriSektor::find($id);

        if (!$industriSektor) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $industriSektor,
        );
        return response()->json($data, $code);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $industri_sektor = RefIndustriSektor::find($id);

        $industri_sektor->delete();

        if (!$industri_sektor) {
            $code     = 400;
            $message  = 'failed';
            $industri_sektor = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $industri_sektor,
        );

        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataIndustriSektor(), 'Data Industri Sektor.xlsx');
    }

    public function template_import()
    {
        return Excel::download(new TemplateImportIndustriSektor, 'Template Import Sektor Industri.xlsx');
    }

    public function import_industri_sektor(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            Excel::import(new ProcessImportIndustriSektor, $request->file);

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
