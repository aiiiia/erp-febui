<?php

namespace App\Http\Controllers\MasterData;

use App\Exports\Position\DownloadDataPosition;
use App\Http\Controllers\Controller;
use App\Models\RefPosition;
use App\Models\RefPositionLevel;
use App\Models\RefPositionType;
use App\Models\RefUnit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PositionController extends Controller
{

    public function index()
    {
        $pos_level    = RefPositionLevel::all();
        $pos_type     = RefPositionType::all();
        $unit         = RefUnit::all();

        $org = ["BOD", "BOD-1", "BOD-2", "BOD-3"];
        $line_manager = RefPosition::whereIn('org_level', $org)->get();

        return view("master-data.position.index", compact('pos_level', 'pos_type', 'unit', 'line_manager'));
    }

    public function dataTablePosition()
    {
        $data = RefPosition::orderBy('code_position')->get([
                    'id',
                    'code_position_level',
                    'code_position_type',
                    'code_unit',
                    'code_position',
                    'nama_position',
                    'org_level',
                    'line_manager',
                ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('code_position_level', function($data) {
                $pos_level = RefPositionLevel::select('nama_position_level')
                                        ->where('code_position_level', $data->code_position_level)
                                        ->first();

                return ''.$pos_level->nama_position_level;
            })
            ->editColumn('code_position_type', function($data) {
                $pos_type = RefPositionType::select('nama_position_type')
                                        ->where('code_position_type', $data->code_position_type)
                                        ->first();

                return ''.$pos_type->nama_position_type;
            })
            ->editColumn('code_unit', function($data) {
                $unit = RefUnit::select('nama_unit')
                                        ->where('code_unit', $data->code_unit)
                                        ->first();

                return ''.$unit->nama_unit;
            })
            ->editColumn('line_manager', function($data) {
                $line_manager = RefPosition::select('nama_position')
                                        ->where('code_position', $data->line_manager)
                                        ->first();

                if(isset($line_manager)){
                    return ''.$line_manager->nama_position;
                }else{
                    return '-';
                }
            })
            ->rawColumns(['code_position_level', 'code_position_type', 'code_unit', 'line_manager'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $pos_level = RefPositionLevel::select('nama_position_level')
                                        ->where('code_position_level', $request->code_position_level)
                                        ->first();

        $dataPositionCreate = [
                                "code_position_level" => $request->code_position_level,
                                "code_position_type" => $request->code_position_type,
                                "code_unit" => $request->code_unit,
                                "code_position" => $request->code_position,
                                "nama_position" => $request->nama_position,
                                "org_level" => $pos_level->nama_position_level,
                                "line_manager" => $request->line_manager,
                                "created_at" => date('Y-m-d H:i:s'),
                                "created_by" => auth()->user()->username
                            ];

        $masterPosition = RefPosition::create($dataPositionCreate);

        return redirect()->route('masterDataPosition.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Position Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $position = RefPosition::find($request->id_value);

        if (!$position) {
            $message = "failed";
            $code    = 400;
        }
        $pos_level = RefPositionLevel::select('nama_position_level')
                                        ->where('code_position_level', $request->code_position_level)
                                        ->first();

        $position->code_position_level = $request->code_position_level;
        $position->code_position_type = $request->code_position_type;
        $position->code_unit = $request->code_unit;
        $position->code_position = $request->code_position;
        $position->nama_position = $request->nama_position;
        $position->org_level = $pos_level->nama_position_level;
        $position->line_manager = $request->line_manager;
        $position->updated_at = date('Y-m-d H:i:s');
        $position->updated_by = auth()->user()->username;

        $position->save();

        return redirect()->route('masterDataPosition.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Position Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $position = RefPosition::find($id);

        $position->delete();

        if (!$position) {
            $code     = 400;
            $message  = 'failed';
            $position = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $position,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $position = false;

        $position = RefPosition::with(['getPositionLevel', 'getPositionType', 'getUnit', 'getLineManager'])
                                ->find($id);

        if (!$position) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $position,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPosition(), 'Data Position.xlsx');
    }
}
