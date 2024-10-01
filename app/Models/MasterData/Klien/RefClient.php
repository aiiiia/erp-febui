<?php

namespace App\Models\MasterData\Klien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefClient extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_client';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getClientJenis()
    {
        return $this->belongsTo(RefClientJenis::class, 'id_jenis', 'id');
    }

    public function getClientLokasi()
    {
        return $this->belongsTo(RefClientLokasi::class, 'id_lokasi', 'id');
    }

    public function getClientSumberDana()
    {
        return $this->belongsTo(RefClientSumberDana::class, 'id_sumber_dana', 'id');
    }
}
