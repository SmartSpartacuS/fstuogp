<?php

namespace App\Mydb;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table = 'soal';
    protected $guarded=[];

    public function aturan()
    {
        return $this->belongsTo(aturan::class);  
    }

}
