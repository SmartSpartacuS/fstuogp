<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table = 'soal';
    protected $guarded=[];


    public function jawaban()
    {
        return $this->hasMany(jawaban::class);
    } 
}
