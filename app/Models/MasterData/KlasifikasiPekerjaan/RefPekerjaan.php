<?php

namespace App\Models\MasterData\KlasifikasiPekerjaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPekerjaan extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_pekerjaan';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getKelompok()
    {
        return $this->belongsTo(RefPekerjaanKelompok::class, 'id_kelompok', 'id');
    }
}
