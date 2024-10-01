<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefBank;
use Yajra\Datatables\Datatables;

class BankController extends Controller
{
    public function index()
    {
        return view("master-data.bank.index");
    }

    public function dataTableBank()
    {
        $data = RefBank::get([
            'id',
            'code_bank',
            'nama_bank',
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dataBankCreate = [
                                "code_bank" => $request->code_bank,
                                "nama_bank" => $request->nama_bank,
                                "created_at" => date('Y-m-d H:i:s'),
                                "created_by" => auth()->user()->username
                            ];

        $masterBank = RefBank::create($dataBankCreate);

        return redirect()->route('masterDataBank.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Bank Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $bank = RefBank::find($request->id_value);

        if (!$bank) {
            $message = "failed";
            $code    = 400;
        }

        $bank->code_bank = $request->code_bank;
        $bank->nama_bank = $request->nama_bank;
        $bank->updated_at = date('Y-m-d H:i:s');
        $bank->updated_by = auth()->user()->username;

        $bank->save();

        return redirect()->route('masterDataBank.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Bank Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $bank = RefBank::find($id);

        $bank->delete();

        if (!$bank) {
            $code     = 400;
            $message  = 'failed';
            $bank = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $bank,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $Bank = false;

        $Bank = RefBank::find($id);

        if (!$Bank) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $Bank,
        );
        return response()->json($data, $code);
    }
}
