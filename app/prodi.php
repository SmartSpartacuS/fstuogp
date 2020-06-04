<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    protected $table='prodi';
    protected $guarded=[];

    public function fakultas()
    {
        return $this->belongsTo(fakultas::class,'id_fakultas');
    }

}
