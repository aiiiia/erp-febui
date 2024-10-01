<?php

namespace App\Http\Controllers\Bapl;

use App\Http\Controllers\Controller;
use App\Models\RefKecamatan;
use App\Models\RefKelurahan;
use App\Models\RefPegawai;
use App\Models\RefPetugas;
use App\Models\Trans;
use App\Models\TransObjek;
use App\Models\TransObjekHotel;
use App\Models\TransObjekRestoran;
use App\Models\TransWp;
use App\Models\TransWb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;

class BaplController extends Controller
{
    public function index()
    {
        $petugas = RefPegawai::all();

        return view("bapl.index", compact('petugas'));
    }

    public function dataTableBapl()
    {
        $data = Trans::orderBy('id', 'DESC')->get([
            'id',
            'tgl_bapl',
            'id_pegawai_1',
            'id_pegawai_2',
            'nama_merk',
            'alamat_merk',
            'npwp_merk',
            'deskripsi_merk',
            'lat',
            'lang',
            'image_1',
            'image_2',
            'map_image',
            'validasi'
        ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('bapl', function ($data) {
                return '<a href="'.route('bapl.bapl', $data->id).'" class="dwl-bapl">
                            <i class="ki-duotone ki-exit-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>';
            })
            ->editColumn('bapl_detail', function ($data) {
                if($data->validasi == 1){
                    return '<a href="'.route('bapl.bapl-pemutakhiran', $data->id).'" class="dwl-bapl">
                            <i class="ki-duotone ki-exit-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>';
                }else{
                    return '-';
                }
            })
            ->rawColumns(['bapl', 'bapl_detail'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $tgl_bapl       = $request->tgl_bapl;
        $id_pegawai_1   = $request->id_pegawai_1;
        $id_pegawai_2   = $request->id_pegawai_2;
        $nama_merk      = $request->nama_merk;
        $alamat_merk    = $request->alamat_merk;
        $npwp_merk      = $request->npwp_merk;
        $deskripsi_merk = $request->deskripsi_merk;
        $lat            = $request->latInput;
        $lang           = $request->lngInput;
        $image_map      = $request->image_map;

        $img_path = 'bapl';
		$filename = null;

        if ($request->hasFile('image_1')) {
            $file = $request->file('image_1');
            $filename = $nama_merk . '_1.' . $file->getClientOriginalExtension();
            $file->move(employee_doc_path($img_path), $filename);
        }

		$filename2 = null;
        if ($request->hasFile('image_2')) {
            $file2 = $request->file('image_2');
            $filename2 = $nama_merk . '_2.' . $file2->getClientOriginalExtension();
            $file2->move(employee_doc_path($img_path), $filename2);
        }

        $dataPegawaiCreate = [
            "tgl_bapl" => $tgl_bapl,
            "id_pegawai_1" => $id_pegawai_1,
            "id_pegawai_2" => $id_pegawai_2,
            "nama_merk" => $nama_merk,
            "alamat_merk" => $alamat_merk,
            "npwp_merk" => $npwp_merk,
            "deskripsi_merk" => $deskripsi_merk,
            "lat" => $lat,
            "lang" => $lang,
            "map_image" => $image_map,
            "image_1" => $filename,
            "image_2" => $filename2,
            "validasi" => "0",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
            "created_by" => auth()->user()->username
        ];

        $masterPegawai = Trans::create($dataPegawaiCreate);

        return redirect()->route('trans.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Penambahan Berita Acara Penelitian Lapangan Berhasil Dilakukan",
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show($id)
    {
        $message  = "success";
        $code     = 200;
        $bapl = Trans::find($id);
        $pegawai = RefPegawai::select('id', 'nama')
                    ->get();

        $comb_peg = '<select class="form-select" aria-label="Select example" name="id_pegawai_1">
                        <option hidden>Silahkan Pilih Petugas Data 1...</option>';

        $comb_peg_2 = $comb_peg;

        foreach($pegawai as $pet){
            if($pet->id == $bapl->id_pegawai_1){
                $comb_peg = $comb_peg.'<option value="'.$pet->id.'" selected>'.$pet->nama.'</option>';
            }else{
                $comb_peg = $comb_peg.'<option value="'.$pet->id.'">'.$pet->nama.'</option>';
            }

            if($pet->id == $bapl->id_pegawai_2){
                $comb_peg2 = $comb_peg_2.'<option value="'.$pet->id.'" selected>'.$pet->nama.'</option>';
            }else{
                $comb_peg2 = $comb_peg_2.'<option value="'.$pet->id.'">'.$pet->nama.'</option>';
            }
        }

        $comb_peg = $comb_peg.'</select>';
        $comb_peg2 = $comb_peg2.'</select>';

        if (!$bapl) {
            $message = "failed";
            $code    = 400;
        }

        $data = array(
            'message' => $message,
            'code'    => $code,
            'data'    => $bapl,
            'petugas' => $comb_peg,
            'petugas2' => $comb_peg2
        );
        return response()->json($data, $code);
    }

    public function search_kel(Request $request)
    {
        $kec = $request->kec;

        $kel = RefKelurahan::query()
            ->where('id_kec', $kec)
            ->get()
            ->map(function ($value) {
                return [
                    'code' => $value->id,
                    'name' => $value->nama,
                    'kode_pos' => $value->kode_pos
                ];
            })->unique()->toArray();

        return response()->json(array_values(array_filter($kel)), 200);
    }

    public function search_kodepos(Request $request)
    {
        $kel = $request->kel;

        $kel = RefKelurahan::select('kode_pos')
                                ->where('id', $kel)
                                ->first();

        return $kel->kode_pos;
    }

    public function pemutakhiran($ids)
    {
        $kecamatan = RefKecamatan::all();
        $kelurahan = RefKelurahan::all();
        $id_trans = $ids;
        $trans_wp = TransWp::where('id_trans', $ids)
                            ->first();

        return view("bapl.pemutakhiran", compact('id_trans', 'trans_wp', 'kecamatan', 'kelurahan'));
    }

    public function pemutakhiran_store(Request $request)
    {
        $petugas = TransWp::updateOrCreate(
                    [
                        'id' => $request->ids,
                        'id_trans' => $request->id_trans
                    ],
                    [
                        'nama' => $request->nama_wp,
                        'no_tlp' => $request->tlp_wp,
                        'no_hp' => $request->hp_wp,
                        'no_fax' => $request->fax_wp,
                        'alamat' => $request->alamat_wp,
                        'rt' => $request->rt_wp,
                        'rw' => $request->rw_wp,
                        'id_kec' => $request->kec_wp,
                        'id_kel' => $request->kel_wp,
                        'kode_pos' => $request->kodepos_wp,
                        'email' => $request->email_wp,
                        'created_by' => auth()->user()->username,
                        'updated_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

        return redirect()->route('bapl.pemutakhiran-badan', $request->id_trans)->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Data Wajib Pajak Berhasil Ditambah/Diubah",
        ]);
    }

    public function pemutakhiran_badan($ids)
    {
        $kecamatan = RefKecamatan::all();
        $kelurahan = RefKelurahan::all();
        $id_trans = $ids;
        $trans_wb = TransWb::where('id_trans', $ids)
                            ->first();

        return view("bapl.pemutakhiran_badan", compact('id_trans', 'trans_wb', 'kecamatan', 'kelurahan'));
    }

    public function pemutakhiran_badan_store(Request $request)
    {
        $petugas = TransWb::updateOrCreate(
                    [
                        'id' => $request->ids,
                        'id_trans' => $request->id_trans
                    ],
                    [
                        'nama' => $request->nama_wb,
                        'no_tlp' => $request->tlp_wb,
                        'no_hp' => $request->hp_wb,
                        'no_fax' => $request->fax_wb,
                        'alamat' => $request->alamat_wb,
                        'rt' => $request->rt_wb,
                        'rw' => $request->rw_wb,
                        'id_kec' => $request->kec_wb,
                        'id_kel' => $request->kel_wb,
                        'kode_pos' => $request->kodepos_wb,
                        'email' => $request->email_wb,
                        'created_by' => auth()->user()->username,
                        'updated_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

        return redirect()->route('bapl.pemutakhiran-objek', $request->id_trans)->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Data Wajib Pajak Badan Berhasil Ditambah/Diubah",
        ]);
    }

    public function pemutakhiran_objek($ids)
    {
        $kecamatan = RefKecamatan::all();
        $kelurahan = RefKelurahan::all();
        $id_trans = $ids;
        $trans_op = TransObjek::where('id_trans', $ids)
                            ->first();

        $trans = Trans::where('id', $ids)
                            ->first();

        return view("bapl.pemutakhiran_objek", compact('id_trans', 'trans_op', 'trans', 'kecamatan', 'kelurahan'));
    }

    public function pemutakhiran_objek_store(Request $request)
    {
        $petugas = TransObjek::updateOrCreate(
                    [
                        'id' => $request->ids,
                        'id_trans' => $request->id_trans
                    ],
                    [
                        'nama' => $request->nama_op,
                        'no_tlp' => $request->tlp_op,
                        'alamat' => $request->alamat_op,
                        'rt' => $request->rt_op,
                        'rw' => $request->rw_op,
                        'id_kec' => $request->kec_op,
                        'id_kel' => $request->kel_op,
                        'kode_pos' => $request->kodepos_op,
                        'jml_peg' => $request->jml_peg_op,
                        'gaji_peg' => $request->gaji_peg_op,
                        'tgl_mulai_usaha' => $request->tgl_mulai_usaha_op,
                        'jenis_objek' => $request->jenis_objek_op,
                        'created_by' => auth()->user()->username,
                        'updated_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

        if($request->jenis_objek_op == 1){
            return redirect()->route('bapl.pemutakhiran-objek-hotel', $request->id_trans)->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Data Objek Pajak Berhasil Ditambah/Diubah",
            ]);
        }else if($request->jenis_objek_op == 2){
            return redirect()->route('bapl.pemutakhiran-objek-resto', $request->id_trans)->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Data Objek Pajak Berhasil Ditambah/Diubah",
            ]);
        }else{
            return redirect()->route('trans.index')->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Data Objek Pajak Berhasil Ditambah/Diubah",
            ]);
        }
    }

    public function pemutakhiran_objek_hotel($ids)
    {
        $id_trans = $ids;
        $trans_op_hotel = TransObjekHotel::where('id_trans', $ids)
                            ->first();

        return view("bapl.pemutakhiran_objek_hotel", compact('id_trans', 'trans_op_hotel'));
    }

    public function pemutakhiran_objek_hotel_store(Request $request)
    {
        $petugas = TransObjekHotel::updateOrCreate(
                    [
                        'id' => $request->ids,
                        'id_trans' => $request->id_trans
                    ],
                    [
                        'jml_kamar' => $request->jml_kamar,
                        'gol_kamar' => $request->gol_kamar,
                        'okupansi' => $request->okupansi,
                        'rate_weekday' => $request->rate_weekday,
                        'rate_weekend' => $request->rate_weekend,
                        'rate_peak_season' => $request->rate_peak_season,
                        'jml_meeting_room' => $request->jml_meeting_room,
                        'kapasitas_meeting_room' => $request->kapasitas_meeting_room,
                        'rate_meeting_room_per_pax' => $request->rate_meeting_room_per_pax,
                        'is_resto' => $request->is_resto,
                        'created_by' => auth()->user()->username,
                        'updated_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

        $trans = Trans::find($request->id_trans);
        $trans->validasi = "1";
        $trans->save();

        if($request->is_resto == 1){
            return redirect()->route('bapl.pemutakhiran-objek-resto', $petugas->id)->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Data Objek Pajak Berhasil Ditambah/Diubah",
            ]);
        }else{
            return redirect()->route('trans.index')->with([
                "status"  => 'success',
                "title"   => 'Success!',
                "message" => "Data Objek Pajak Hotel Berhasil Ditambah/Diubah",
            ]);
        }
    }

    public function pemutakhiran_objek_resto($ids)
    {
        $id_trans = $ids;
        $trans_op_resto = TransObjekRestoran::where('id_trans', $ids)
                            ->first();

        return view("bapl.pemutakhiran_objek_resto", compact('id_trans', 'trans_op_resto'));
    }

    public function pemutakhiran_objek_resto_store(Request $request)
    {
        $petugas = TransObjekRestoran::updateOrCreate(
            [
                'id' => $request->ids,
                'id_trans' => $request->id_trans
            ],
            [
                'jml_meja' => $request->jml_meja,
                'jml_kursi' => $request->jml_kursi,
                'food_min_price' => $request->food_min_price,
                'food_max_price' => $request->food_max_price,
                'drink_min_price' => $request->drink_min_price,
                'drink_max_price' => $request->drink_max_price,
                'daya_tampung' => $request->daya_tampung,
                'avg_attendance_month' => $request->avg_attendance_month,
                'created_by' => auth()->user()->username,
                'updated_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        $trans = Trans::find($request->id_trans);
        $trans->validasi = "1";
        $trans->save();

        return redirect()->route('trans.index')->with([
            "status"  => 'success',
            "title"   => 'Success!',
            "message" => "Data Objek Pajak Hotel Berhasil Ditambah/Diubah",
        ]);
    }

    public function export_bapl($ids)
    {
        $trans = Trans::select('trans.tgl_bapl',
                                'a.nip as nip_ptgs_1',
                                'a.nama as nama_ptgs_1',
                                'a.jabatan as jabatan_ptgs_1',
                                'b.nip as nip_ptgs_2',
                                'b.nama as nama_ptgs_2',
                                'b.jabatan as jabatan_ptgs_2',
                                'trans.nama_merk',
                                'trans.alamat_merk',
                                'trans.npwp_merk',
                                'trans.deskripsi_merk',
                                'trans.image_1',
                                'trans.image_2',
                                'trans.map_image as map',
                            )
                        ->leftJoin(DB::raw('pegawai a'),'a.id', '=', 'trans.id_pegawai_1')
                        ->leftJoin(DB::raw('pegawai b'),'b.id', '=', 'trans.id_pegawai_2')
                        ->first();

        $petugas = RefPetugas::select('nama_pj', 'jabatan_pj')
                            ->first();

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('documents/bapl.docx'));

        $pecah = explode("-", $trans->tgl_bapl);

		$tahun = $pecah[0];
		$bulan = get_month($pecah[1]);
		$hari = $pecah[2];

		$tgl = $hari." ".$bulan." ".$tahun;
		$dates = strtotime($trans->tgl_bapl);
		$date_val = date('l', $dates);

		$date = get_day($date_val);

        $templateProcessor->setValue("tgl_bapl",htmlspecialchars(html_entity_decode($tgl)));
        $templateProcessor->setValue("tanggal",htmlspecialchars(html_entity_decode($hari)));
        $templateProcessor->setValue("bulan",htmlspecialchars(html_entity_decode($bulan)));
        $templateProcessor->setValue("tahun",htmlspecialchars(html_entity_decode($tahun)));
        $templateProcessor->setValue("date",htmlspecialchars(html_entity_decode($date)));

        $templateProcessor->setValue("nip_ptgs_1",htmlspecialchars(html_entity_decode($trans->nip_ptgs_1)));
        $templateProcessor->setValue("nama_ptgs_1",htmlspecialchars(html_entity_decode($trans->nama_ptgs_1)));
        $templateProcessor->setValue("jabatan_ptgs_1",htmlspecialchars(html_entity_decode($trans->jabatan_ptgs_1)));
        $templateProcessor->setValue("nip_ptgs_2",htmlspecialchars(html_entity_decode($trans->nip_ptgs_2)));
        $templateProcessor->setValue("nama_ptgs_2",htmlspecialchars(html_entity_decode($trans->nama_ptgs_2)));
        $templateProcessor->setValue("jabatan_ptgs_2",htmlspecialchars(html_entity_decode($trans->jabatan_ptgs_2)));

        $templateProcessor->setValue("nama_pj",htmlspecialchars(html_entity_decode($petugas->nama_pj)));
        $templateProcessor->setValue("jabatan_pj",htmlspecialchars(html_entity_decode($petugas->jabatan_pj)));

        $templateProcessor->setValue("nama_merk",htmlspecialchars(html_entity_decode($trans->nama_merk)));
        $templateProcessor->setValue("alamat_merk",htmlspecialchars(html_entity_decode($trans->alamat_merk)));
        $templateProcessor->setValue("npwp_merk",htmlspecialchars(html_entity_decode($trans->npwp_merk)));

        $templateProcessor->setValue('deskripsi_merk', htmlspecialchars(strip_tags($trans->deskripsi_merk)));

        $width = "1000";
        $height = "1000";

        $templateProcessor->setImageValue('image_1', array('src' => employee_doc_path('bapl/'.$trans->image_1),'swh'=>'200', 'size'=> array(0=>$width, 1=>$height)));
        $templateProcessor->setImageValue('image_2', array('src' => employee_doc_path('bapl/'.$trans->image_2),'swh'=>'200', 'size'=> array(0=>$width, 1=>$height)));
        $templateProcessor->setImageValue('map', array('src' => $trans->map,'swh'=>'200', 'size'=> array(0=>$width, 1=>$height)));

        $path = storage_path('documents/download/laporan_'.$trans->nama_merk.'.docx');
        $templateProcessor->saveAs($path);

        return response()->download(storage_path('documents/download/laporan_'.$trans->nama_merk.'.docx'));
    }

    public function export_bapl_pemutakhiran($ids)
    {
        $trans_wp = TransWp::select('trans_wp.nama',
                                        'trans_wp.no_tlp',
                                        'trans_wp.no_hp',
                                        'trans_wp.no_fax',
                                        'trans_wp.alamat',
                                        'trans_wp.rt',
                                        'trans_wp.rw',
                                        'a.nama as kecamatan',
                                        'b.nama as kelurahan',
                                        'trans_wp.kode_pos',
                                        'trans_wp.email',
                                )
                            ->leftJoin(DB::raw('kecamatan a'),'a.id', '=', 'trans_wp.id_kec')
                            ->leftJoin(DB::raw('kelurahan b'),'b.id', '=', 'trans_wp.id_kel')
                            ->where('id_trans', $ids)
                            ->first();

        $trans_wb = TransWb::select('trans_wb.nama',
                                        'trans_wb.no_tlp',
                                        'trans_wb.no_hp',
                                        'trans_wb.no_fax',
                                        'trans_wb.alamat',
                                        'trans_wb.rt',
                                        'trans_wb.rw',
                                        'a.nama as kecamatan',
                                        'b.nama as kelurahan',
                                        'trans_wb.kode_pos',
                                        'trans_wb.email',
                                )
                            ->leftJoin(DB::raw('kecamatan a'),'a.id', '=', 'trans_wb.id_kec')
                            ->leftJoin(DB::raw('kelurahan b'),'b.id', '=', 'trans_wb.id_kel')
                            ->where('id_trans', $ids)
                            ->first();

        $trans_op = TransObjek::select('trans_objek.nama',
                                        'trans_objek.no_tlp',
                                        'trans_objek.alamat',
                                        'trans_objek.rt',
                                        'trans_objek.rw',
                                        'a.nama as kecamatan',
                                        'b.nama as kelurahan',
                                        'trans_objek.kode_pos',
                                        'trans_objek.jml_peg',
                                        'trans_objek.gaji_peg',
                                        'trans_objek.tgl_mulai_usaha',
                                        'trans_objek.jenis_objek',
                                )
                            ->leftJoin(DB::raw('kecamatan a'),'a.id', '=', 'trans_objek.id_kec')
                            ->leftJoin(DB::raw('kelurahan b'),'b.id', '=', 'trans_objek.id_kel')
                            ->where('id_trans', $ids)
                            ->first();

        $trans_op_hotel = TransObjekHotel::select('jml_kamar',
                                        'gol_kamar',
                                        'okupansi',
                                        'rate_weekday',
                                        'rate_weekend',
                                        'rate_peak_season',
                                        'jml_meeting_room',
                                        'kapasitas_meeting_room',
                                        'rate_meeting_room_per_pax',
                                        'is_resto',
                                )
                            ->where('id_trans', $ids)
                            ->first();

        $trans_op_resto = TransObjekRestoran::select('jml_meja',
                                        'jml_kursi',
                                        'food_min_price',
                                        'food_max_price',
                                        'drink_min_price',
                                        'drink_max_price',
                                        'daya_tampung',
                                        'avg_attendance_month',
                                )
                            ->where('id_trans', $ids)
                            ->first();


        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('documents/bapl-pemutakhiran.docx'));

        $templateProcessor->setValue("nama_wp",htmlspecialchars(html_entity_decode($trans_wp->nama)));
        $templateProcessor->setValue("no_tlp_wp",htmlspecialchars(html_entity_decode($trans_wp->no_tlp)));
        $templateProcessor->setValue("no_hp_wp",htmlspecialchars(html_entity_decode($trans_wp->no_hp)));
        $templateProcessor->setValue("no_fax_wp",htmlspecialchars(html_entity_decode($trans_wp->no_fax)));
        $templateProcessor->setValue("alamat_wp",htmlspecialchars(html_entity_decode($trans_wp->alamat)));
        $templateProcessor->setValue("rt_wp",htmlspecialchars(html_entity_decode($trans_wp->rt)));
        $templateProcessor->setValue("rw_wp",htmlspecialchars(html_entity_decode($trans_wp->rw)));
        $templateProcessor->setValue("kel_wp",htmlspecialchars(html_entity_decode($trans_wp->kelurahan)));
        $templateProcessor->setValue("kec_wp",htmlspecialchars(html_entity_decode($trans_wp->kecamatan)));
        $templateProcessor->setValue("kodepos_wp",htmlspecialchars(html_entity_decode($trans_wp->kode_pos)));
        $templateProcessor->setValue("email_wp",htmlspecialchars(html_entity_decode($trans_wp->email)));

        $templateProcessor->setValue("nama_wb",htmlspecialchars(html_entity_decode($trans_wb->nama)));
        $templateProcessor->setValue("no_tlp_wb",htmlspecialchars(html_entity_decode($trans_wb->no_tlp)));
        $templateProcessor->setValue("no_hp_wb",htmlspecialchars(html_entity_decode($trans_wb->no_hp)));
        $templateProcessor->setValue("no_fax_wb",htmlspecialchars(html_entity_decode($trans_wb->no_fax)));
        $templateProcessor->setValue("alamat_wb",htmlspecialchars(html_entity_decode($trans_wb->alamat)));
        $templateProcessor->setValue("rt_wb",htmlspecialchars(html_entity_decode($trans_wb->rt)));
        $templateProcessor->setValue("rw_wb",htmlspecialchars(html_entity_decode($trans_wb->rw)));
        $templateProcessor->setValue("kel_wb",htmlspecialchars(html_entity_decode($trans_wb->kelurahan)));
        $templateProcessor->setValue("kec_wb",htmlspecialchars(html_entity_decode($trans_wb->kecamatan)));
        $templateProcessor->setValue("kodepos_wb",htmlspecialchars(html_entity_decode($trans_wb->kode_pos)));
        $templateProcessor->setValue("email_wb",htmlspecialchars(html_entity_decode($trans_wb->email)));

        $templateProcessor->setValue("nama_op",htmlspecialchars(html_entity_decode($trans_op->nama)));
        $templateProcessor->setValue("no_tlp_op",htmlspecialchars(html_entity_decode($trans_op->no_tlp)));
        $templateProcessor->setValue("alamat_op",htmlspecialchars(html_entity_decode($trans_op->alamat)));
        $templateProcessor->setValue("rt_op",htmlspecialchars(html_entity_decode($trans_op->rt)));
        $templateProcessor->setValue("rw_op",htmlspecialchars(html_entity_decode($trans_op->rw)));
        $templateProcessor->setValue("kel_op",htmlspecialchars(html_entity_decode($trans_op->kelurahan)));
        $templateProcessor->setValue("kec_op",htmlspecialchars(html_entity_decode($trans_op->kecamatan)));
        $templateProcessor->setValue("kodepos_op",htmlspecialchars(html_entity_decode($trans_op->kode_pos)));
        $templateProcessor->setValue("jml_peg_op",htmlspecialchars(html_entity_decode($trans_op->jml_peg)));
        $templateProcessor->setValue("gaji_peg_op",htmlspecialchars(html_entity_decode($trans_op->gaji_peg)));
        $templateProcessor->setValue("tgl_mulai_usaha_op",htmlspecialchars(html_entity_decode($trans_op->tgl_mulai_usaha)));

        $templateProcessor->setValue("jml_kamar",htmlspecialchars(html_entity_decode($trans_op_hotel->jml_kamar)));
        $templateProcessor->setValue("gol_kamar",htmlspecialchars(html_entity_decode($trans_op_hotel->gol_kamar)));
        $templateProcessor->setValue("okupansi",htmlspecialchars(html_entity_decode($trans_op_hotel->okupansi)));
        $templateProcessor->setValue("rate_weekday",htmlspecialchars(html_entity_decode($trans_op_hotel->rate_weekday)));
        $templateProcessor->setValue("rate_weekend",htmlspecialchars(html_entity_decode($trans_op_hotel->rate_weekend)));
        $templateProcessor->setValue("rate_peak_season",htmlspecialchars(html_entity_decode($trans_op_hotel->rate_peak_season)));
        $templateProcessor->setValue("jml_meeting_room",htmlspecialchars(html_entity_decode($trans_op_hotel->jml_meeting_room)));
        $templateProcessor->setValue("kapasitas_meeting_room",htmlspecialchars(html_entity_decode($trans_op_hotel->kapasitas_meeting_room)));
        $templateProcessor->setValue("rate_meeting_room_per_pax",htmlspecialchars(html_entity_decode($trans_op_hotel->rate_meeting_room_per_pax)));

        $templateProcessor->setValue("jml_meja",htmlspecialchars(html_entity_decode($trans_op_resto->jml_meja)));
        $templateProcessor->setValue("jml_kursi",htmlspecialchars(html_entity_decode($trans_op_resto->jml_kursi)));
        $templateProcessor->setValue("food_min_price",htmlspecialchars(html_entity_decode($trans_op_resto->food_min_price)));
        $templateProcessor->setValue("food_max_price",htmlspecialchars(html_entity_decode($trans_op_resto->food_max_price)));
        $templateProcessor->setValue("drink_min_price",htmlspecialchars(html_entity_decode($trans_op_resto->drink_min_price)));
        $templateProcessor->setValue("drink_max_price",htmlspecialchars(html_entity_decode($trans_op_resto->drink_max_price)));
        $templateProcessor->setValue("daya_tampung",htmlspecialchars(html_entity_decode($trans_op_resto->daya_tampung)));
        $templateProcessor->setValue("avg_attendance_month",htmlspecialchars(html_entity_decode($trans_op_resto->avg_attendance_month)));

        $path = storage_path('documents/download/laporan_'.$trans_op->nama.'_pemutakhiran_data.docx');
        $templateProcessor->saveAs($path);

        return response()->download(storage_path('documents/download/laporan_'.$trans_op->nama.'_pemutakhiran_data.docx'));
    }
}
