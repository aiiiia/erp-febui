<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefPegawai extends Model
{
    protected $table   = 'ref_pegawai';
    protected $guarded = [];

    public function getPosition()
    {
        return $this->belongsTo(RefPosition::class, 'code_position', 'code_position');
    }
}
