<?php

namespace App\Mydb;

use App\jadwal;
use Illuminate\Database\Eloquent\Model;

class kontrak extends Model
{
    protected $table = 'kontrak';
    protected $guarded=[];

    public function krs()
    {
        return $this->belongsTo(krs::class);  
    }
    public function jadwal()
    {
        return $this->belongsTo(jadwal::class);  
    }
}
