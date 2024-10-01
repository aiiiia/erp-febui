<?php

namespace App\Models\MasterData\Honor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefHonorInternal extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_honor_internal';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
