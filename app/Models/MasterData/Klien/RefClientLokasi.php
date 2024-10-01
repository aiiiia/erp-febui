<?php

namespace App\Models\MasterData\Klien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefClientLokasi extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_client_lokasi';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
