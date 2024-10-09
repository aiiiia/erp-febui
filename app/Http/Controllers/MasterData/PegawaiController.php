<?php

namespace App\Http\Controllers\MasterData;

use App\Exports\Pegawai\TemplateImportPegawai;
use App\Imports\Pegawai\ProcessImportPegawai;
use App\Exports\Pegawai\DownloadDataPegawai;
use App\Http\Controllers\Controller;
use App\Models\RefPegawai;
use App\Models\RefPosition;
use App\Models\RefPositionLevel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    public function index()
    {
        $position   = RefPosition::all();
        $pos_level  = RefPositionLevel::all();

        return view("master-data.pegawai.index", compact('position', 'pos_level'));
    }

    public function dataTablePegawai()
    {
        $data = RefPegawai::orderBy('nip')->get([
            'id',
            'nip',
            'nama',
            'code_position',
            'bod_type',
            'status_karyawan',
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('code_position', function($data) {
                $position = RefPosition::select('nama_position')
                                        ->where('code_position', $data->code_position)
                                        ->first();

                return ''.$position->nama_position;
            })
            ->rawColumns(['code_position'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $pos_level = RefPositionLevel::select('nama_position_level')
                                        ->where('code_position_level', $request->bod_type)
                                        ->first();

        $dataPegawaiCreate = [
                                "nip" => $request->nip,
                                "nama" => $request->nama,
                                "job_title" => $request->job_title,
                                "code_position" => $request->code_position,
                                "bod_type" => $pos_level->nama_position_level,
                                "status_karyawan" => $request->status_karyawan,
                                "jenis_kelamin" => $request->jenis_kelamin,
                                "tempat_lahir" => $request->tempat_lahir,
                                "tgl_lahir" => $request->tgl_lahir,
                                "agama" => $request->agama,
                                "marst" => $request->marst,
                                "alamat" => $request->alamat,
                                "no_ktp" => $request->no_ktp,
                                "no_npwp" => $request->no_npwp,
                                "email" => $request->email,
                                "no_hp" => $request->no_hp,
                                "created_at" => date('Y-m-d H:i:s'),
                                "created_by" => auth()->user()->username
                            ];

        $masterPegawai = RefPegawai::create($dataPegawaiCreate);

        return redirect()->route('masterDataPegawai.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Data Pegawai Berhasil Dilakukan",
        ]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = RefPegawai::find($request->id_value);

        if (!$pegawai) {
            $message = "failed";
            $code    = 400;
        }
        $pos_level = RefPositionLevel::select('nama_position_level')
                                        ->where('code_position_level', $request->bod_type)
                                        ->first();

        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->job_title = $request->job_title;
        $pegawai->code_position = $request->code_position;
        $pegawai->bod_type = $pos_level->nama_position_level;
        $pegawai->status_karyawan = $request->status_karyawan;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->agama = $request->agama;
        $pegawai->marst = $request->marst;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_ktp = $request->no_ktp;
        $pegawai->no_npwp = $request->no_npwp;
        $pegawai->email = $request->email;
        $pegawai->no_hp = $request->no_hp;
        $pegawai->updated_at = date('Y-m-d H:i:s');
        $pegawai->updated_by = auth()->user()->username;

        $pegawai->save();

        return redirect()->route('masterDataPegawai.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Perubahan Data Pegawai Berhasil Dilakukan",
        ]);
    }

    public function destroy($id)
    {
        $code     = 200;
        $message  = 'success';
        $pegawai = RefPegawai::find($id);

        $pegawai->delete();

        if (!$pegawai) {
            $code     = 400;
            $message  = 'failed';
            $pegawai = false;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pegawai,
        );

        return response()->json($data, $code);
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $pegawai = false;

        $pegawai = RefPegawai::with(['getPosition' => function($query) {
            $query->with('getPositionLevel');
        }])
                                ->find($id);

        if (!$pegawai) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $pegawai,
        );
        return response()->json($data, $code);
    }

    public function export() {
        return Excel::download(new DownloadDataPegawai(), 'Data Pegawai.xlsx');
    }

    public function template_import()
    {

        return Excel::download(new TemplateImportPegawai, 'Template Import Pegawai.xlsx');
    }

    public function import_pegawai(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = Excel::import(new ProcessImportPegawai, $request->file);

            return redirect()->back()->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "File has been import",
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            dd($failures);

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
