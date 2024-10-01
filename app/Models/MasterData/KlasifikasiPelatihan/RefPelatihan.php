<?php

namespace App\Models\MasterData\KlasifikasiPelatihan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPelatihan extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_pelatihan';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getKelompok()
    {
        return $this->belongsTo(RefPelatihanKelompok::class, 'id_kelompok', 'id');
    }
}
