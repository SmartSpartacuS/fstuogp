<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use App\jawaban;
use App\mulaiJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $jawaban = new jawaban();
        // $jawaban->id_soal=$request->id_soal;
        // $jawaban->NPM=Auth::user()->username;
        // $jawaban->jawaban=$request->jawaban;
        // $jawaban->waktu_jawab=$request->waktu_jawab;
        // $jawaban->save();

        // return ($request);

        $mulaiJawab=jawaban::where('NPM',Auth::user()->username)->first();

        if ($mulaiJawab) {
            return redirect()->route('mhs');
        }

        
        $data = $request->all(); 
        
        
        
        // return $data;
     
        foreach ($data['id_soal'] as $index => $id_soalNo) {
            jawaban::create([
                'id_soal' => $id_soalNo,
                'NPM' => Auth::user()->username,
                'jawaban' => $data['jawaban'][$index],
                'waktu_jawab' => $data['waktu_jawab'],
            ]);
        }


        mulaiJawab::where('NPM',Auth::user()->username)
            ->update([
                'status'=>'off',
            ]);

            return redirect()->route('mhs');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(jawaban $jawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit(jawaban $jawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jawaban $jawaban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(jawaban $jawaban)
    {
        //
    }
}
