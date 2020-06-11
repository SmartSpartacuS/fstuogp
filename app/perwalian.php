<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perwalian extends Model
{
    protected $guarded=[];

    public function mhs()
    {
        return $this->belongsTo(mhs::class);
    }
    public function dosen()
    {
        return $this->belongsTo(dosen::class);
    }
}
