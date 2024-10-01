<?php

namespace App\Http\Controllers\MasterData;

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
}
