<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefBank extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_bank';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
