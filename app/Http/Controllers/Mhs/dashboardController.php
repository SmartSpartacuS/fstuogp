<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use App\jawaban;
use App\mulaiJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $mulaiJawab = mulaiJawab::where('NPM',Auth::user()->username)->where('status','aktif')->first();
        if ($mulaiJawab) {
            return redirect()->route('tampilSoal');
        }


        $sudahJawab = jawaban::where('NPM',Auth::user()->username)->first();  
        $jawaban = jawaban::where('NPM',Auth::user()->username)->get();  
        return view('mhs.dashboard.index',[
            'jawaban'=>$jawaban,
            'sudahJawab'=>$sudahJawab,
        ]);
    }
}
