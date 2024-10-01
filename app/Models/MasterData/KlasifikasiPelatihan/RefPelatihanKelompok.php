<?php

namespace App\Models\MasterData\KlasifikasiPelatihan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPelatihanKelompok extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_pelatihan_kelompok';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

}
