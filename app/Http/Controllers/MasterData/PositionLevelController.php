<?php

namespace App\Http\Controllers\MasterData;

use App\Exports\PositionLevel\DownloadDataPositionLevel;
use App\Http\Controllers\Controller;
use App\Models\RefPositionLevel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PositionLevelController extends Controller
{
    public function index()
    {
        return view("master-data.position-level.index");
    }

    public function dataTablePositionLevel()
    {
        $data = RefPositionLevel::get([
            'id',
            'code_position_level',
            'nama_position_level',
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataPositionLevelCreate = [
                                        "code_position_level" => $request->code_position_level,
                                        "nama_position_level" => $request->nama_position_level,
                                        "created_at" => date('Y-m-d H:i:s'),
                                        "created_by" => auth()->user()->username
                                    ];

        $masterPositionLevel = RefPositionLevel::create($dataPositionLevelCreate);

        return redirect()->route('masterDataPositionLevel.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Position Level Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $position_level = RefPositionLevel::find($request->id_value);

        if (!$position_level) {
            $message = "failed";
            $code    = 400;
        }

        $position_level->code_position_level = $request->code_position_level;
        $position_level->nama_position_level = $request->nama_position_level;
        $position_level->updated_at = date('Y-m-d H:i:s');
        $position_level->updated_by = auth()->user()->username;

        $position_level->save();

        return redirect()->route('masterDataPositionLevel.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Position Level Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $position_level = RefPositionLevel::find($id);

        $position_level->delete();

        if (!$position_level) {
            $code     = 400;
            $message  = 'failed';
            $position_level = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $position_level,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $PositionLevel = false;

        $PositionLevel = RefPositionLevel::find($id);

        if (!$PositionLevel) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $PositionLevel,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPositionLevel(), 'Data Position Level.xlsx');
    }
}
