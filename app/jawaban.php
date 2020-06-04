<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    protected $table = 'jawaban';
    protected $guarded=[];

    public function soal()
    {
        return $this->belongsTo(soal::class,'id_soal');
    }
    public function mhs()
    {
        return $this->belongsTo(mhs::class,'id_mhs');
    }
}
