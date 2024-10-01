<?php

namespace App\Models;

use App\Models\RefPositionLevel;
use App\Models\RefPositionType;
use App\Models\RefUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefPosition extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_position';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function getPositionLevel()
    {
        return $this->belongsTo(RefPositionLevel::class, 'code_position_level', 'code_position_level');
    }

    public function getPositionType()
    {
        return $this->belongsTo(RefPositionType::class, 'code_position_type', 'code_position_type');
    }

    public function getUnit()
    {
        return $this->belongsTo(RefUnit::class, 'code_unit', 'code_unit');
    }

    public function getLineManager()
    {
        return $this->belongsTo(RefPosition::class, 'line_manager', 'code_position');
    }
}
