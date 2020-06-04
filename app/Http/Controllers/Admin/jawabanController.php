<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\jawaban;
use Illuminate\Http\Request;

class jawabanController extends Controller
{
    public function semuaJawaban()
    {
        $jawaban= jawaban::selectRaw('NPM')->groupBy('NPM')->orderByDesc('id')->get();
        return view ('admin.jawaban.index',[
            'jawaban'=>$jawaban,
        ]);
    }

    public function jawabanMhs($npm)
    {
        $mhs= jawaban::where('NPM',$npm)->first();
        $jawaban= jawaban::where('NPM',$npm)->get();
        return view('admin.jawaban.lihat',[
            'jawaban'=>$jawaban,
            'mhs'=>$mhs,
        ]);
    }
}
