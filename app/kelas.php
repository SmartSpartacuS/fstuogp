<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded=[];

    public function jadwal()
    {
        return $this->hasOne(kelas::class);
    }
}
