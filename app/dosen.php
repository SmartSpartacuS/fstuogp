<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    protected $table='dosen';
    protected $guarded=[]; 

    public function prodi()
    {
        return $this->belongsTo(prodi::class);
    }
    public function jadwal()
    {
        return $this->hasMany(jadwal::class,'id_dosen');
    }
}
