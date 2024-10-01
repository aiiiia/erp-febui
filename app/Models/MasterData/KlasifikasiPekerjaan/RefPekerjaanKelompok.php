<?php

namespace App\Models\MasterData\KlasifikasiPekerjaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPekerjaanKelompok extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_pekerjaan_kelompok';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

}
