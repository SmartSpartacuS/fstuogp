<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mhs extends Model
{
    protected $table = 'mhs';
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(prodi::class,'id_prodi');
    }
}
