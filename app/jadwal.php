<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $table = 'jadwal';
    protected $guarded=[];

    public function prodi()
    {
        return $this->belongsTo(prodi::class,'id_prodi');
    }

    public function matkul()
    {
        return $this->belongsTo(matkul::class,'id_matkul');
    }

    public function ruang()
    {
        return $this->belongsTo(ruang::class,'id_ruang',);
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class,'id_dosen');
    }
    public function kelas()
    {
        return $this->hasOne(kelas::class);
    }
}
