<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tool extends Model
{
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(prodi::class,'id_prodi');
    }
}
