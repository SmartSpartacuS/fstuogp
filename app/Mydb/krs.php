<?php

namespace App\Mydb;

use App\perwalian;
use Illuminate\Database\Eloquent\Model;

class krs extends Model
{
    protected $table = 'krs';
    protected $guarded=[];

    public function perwalian()
    {
        return $this->belongsTo(perwalian::class);  
    }

    public function kontrak()
    {
        return $this->hasMany(kontrak::class);
    }
}
