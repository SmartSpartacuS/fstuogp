<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class perwalian extends Model
{
    protected $guarded=[];
    // use SoftDeletes;

    public function mhs()
    {
        return $this->belongsTo(mhs::class);
    }
    public function dosen()
    {
        return $this->belongsTo(dosen::class);
    }
}
