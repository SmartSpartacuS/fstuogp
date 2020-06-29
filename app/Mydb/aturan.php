<?php

namespace App\Mydb;

use App\jadwal;
use Illuminate\Database\Eloquent\Model;

class aturan extends Model
{
    protected $table = 'aturan';
    protected $guarded=[];

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class);  
    }
}
