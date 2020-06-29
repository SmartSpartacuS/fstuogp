<?php

namespace App\Http\Controllers\Dosen;

use App\dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        return view('pekerja.dosen.dashboard.index');
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
