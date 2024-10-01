<?php

namespace App\Models\MasterData\KlasifikasiIndustri;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefIndustriSektor extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_industri_sektor';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

}
