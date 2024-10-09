<?php

namespace App\Http\Controllers\MasterData;

use App\Imports\PositionType\ProcessImportPositionType;
use App\Exports\PositionType\TemplateImportPositionType;
use App\Exports\PositionType\DownloadDataPositionType;
use App\Http\Controllers\Controller;
use App\Models\RefPositionType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PositionTypeController extends Controller
{
    public function index()
    {
        return view("master-data.position-type.index");
    }

    public function dataTablePositionType()
    {
        $data = RefPositionType::get([
            'id',
            'code_position_type',
            'nama_position_type',
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataPositionTypeCreate = [
                                        "code_position_type" => $request->code_position_type,
                                        "nama_position_type" => $request->nama_position_type,
                                        "created_at" => date('Y-m-d H:i:s'),
                                        "created_by" => auth()->user()->username
                                    ];

        $masterPositionType = RefPositionType::create($dataPositionTypeCreate);

        return redirect()->route('masterDataPositionType.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Position Type Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $position_type = RefPositionType::find($request->id_value);

        if (!$position_type) {
            $message = "failed";
            $code    = 400;
        }

        $position_type->code_position_type = $request->code_position_type;
        $position_type->nama_position_type = $request->nama_position_type;
        $position_type->updated_at = date('Y-m-d H:i:s');
        $position_type->updated_by = auth()->user()->username;

        $position_type->save();

        return redirect()->route('masterDataPositionType.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Position Type Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $position_type = RefPositionType::find($id);

        $position_type->delete();

        if (!$position_type) {
            $code     = 400;
            $message  = 'failed';
            $position_type = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $position_type,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $PositionType = false;

        $PositionType = RefPositionType::find($id);

        if (!$PositionType) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $PositionType,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPositionType(), 'Data Position Type.xlsx');
    }

    public function template_import()
    {
        return Excel::download(new TemplateImportPositionType, 'Template Import Position Type.xlsx');
    }

    public function import_position_type(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportPositionType, $request->file);

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
