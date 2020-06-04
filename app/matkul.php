<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matkul extends Model
{
    protected $table = 'matkul';
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(prodi::class,'id_prodi');
    }
}
