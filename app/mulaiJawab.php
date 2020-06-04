<?php

namespace App;
use App\mhs;
use Illuminate\Database\Eloquent\Model;

class mulaiJawab extends Model
{
    protected $table = 'mulai_jawab';
    protected $guarded=[];

    public function mhs()
    {
        return $this->belongsTo(mhs::class,'id_mhs');
    }
}
