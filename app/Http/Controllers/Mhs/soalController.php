<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use App\jawaban;
use App\mulaiJawab;
use App\soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class soalController extends Controller
{
    public function tampil () 
    {
        $sudahJawab = jawaban::where('NPM',Auth::user()->username)->first();

        if ($sudahJawab) {
            return redirect()->route('mhs');
        }

        $waktu = mulaiJawab::where('NPM',Auth::user()->username)->first();

        $soal = soal::all();
        // $soalEsay = soal::where('jenis_soal','Esay')->get();


        return view('mhs.soal.index',[
            'waktu'=>$waktu,
            'soal'=>$soal,
            // 'soalEsay'=>$soalEsay,
        ]);
    }
}
