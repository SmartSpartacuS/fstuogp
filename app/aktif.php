<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aktif extends Model
{
    protected $table = 'aktif';
    protected $guarded=[];

    public function mhs()
    {
        return $this->belongsTo(mhs::class,'id_mhs');  
    }
}
