<?php

namespace App\Models\MasterData\Honor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefHonorRiset extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_honor_riset';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
