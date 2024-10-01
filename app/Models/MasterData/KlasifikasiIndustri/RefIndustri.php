<?php

namespace App\Models\MasterData\KlasifikasiIndustri;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefIndustri extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_industri';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getSektor()
    {
        return $this->belongsTo(RefIndustriSektor::class, 'id_sektor', 'id');
    }
}
