<?php

namespace App\Http\Controllers\Dosen;

use App\dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $matkul= dosen::with(['jadwal'=>function($jadwal){
            $jadwal->with('matkul');
        }
        ])->where('id',auth()->user()->id)->get();
        
        return view('pekerja.dosen.dashboard.index',[
            'matkul'=>$matkul,
        ]);
    }
    public function testing()
    {
        $dosen=dosen::with(['jadwal'=>function($jadwal){
            $jadwal->with('matkul');
        }
        ])->where('id',auth()->user()->id)->get();
        return $dosen;
    }
}
