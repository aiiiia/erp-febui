<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Jobs\SendBulkQueueEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view("master-data.user.index");
    }

    public function dataTableUser()
    {
        $data = User::get([
            'id',
            'username',
            'name'
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
            $dataUserCreate = [
                                "id" => Str::uuid(),
                                "username" => $request->username,
                                "name" => $request->name,
                                "password" => Hash::make("erpfebui2024"),
                                "email" => $request->email,
                                "role" => "2",
                                "created_at" => date('Y-m-d H:i:s'),
                            ];

        $masterUser = User::create($dataUserCreate);

        $data =  [
                    'emails'            => trim(strtolower($request->email)),
                    'type'              => 'first_register',
                    'nama'              => $request->name,
                    'username'          => $request->username,
                    'password'          => "erpfebui2024",
                    'url'               => config('app.url'),
                ];

        $job = (new SendBulkQueueEmail([$data]))->delay(now()->addSeconds(3));
        dispatch($job);

        return redirect()->route('masterDataUser.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan User Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($request->id);

        if (!$user) {
            $message = "failed";
            $code    = 400;
        }

        $user->username = $request->username;
        $user->name = $request->name;
        $user->updated_at = date('Y-m-d H:i:s');

        $user->save();

        return redirect()->back()->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Data User Berhasil Diubah",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $user = User::find($id);

        $user->delete();

        if (!$user) {
            $code     = 400;
            $message  = 'failed';
            $user = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $user,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $user = false;

        $user = User::find($id);

        if (!$user) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $user,
        );
        return response()->json($data, $code);
    }
}
