<?php

namespace App\Models;

use App\Models\RefPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPositionType extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_position_type';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getPosition()
    {
        return $this->hasMany(RefPosition::class);
    }
}
