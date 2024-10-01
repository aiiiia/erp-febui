<?php

namespace App\Models\MasterData\Klien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefClientSumberDana extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_client_sumber_dana';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
