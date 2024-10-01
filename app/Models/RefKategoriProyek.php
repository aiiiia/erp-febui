<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefKategoriProyek extends Model
{
    use SoftDeletes;

    protected $table   = 'ref_kategori_proyek';
    protected $dates   = ['deleted_at'];
    protected $guarded = [];
}
