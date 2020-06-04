<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\soal;
use Illuminate\Http\Request;

class soalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soal = soal::all();
        return view('admin.soal.index',[
            'soal'=> $soal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.soal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $soal = new soal();
        $soal->jenis_soal=$request->jenis_soal;
        $soal->pertanyaan=$request->pertanyaan;
        $soal->gambar=$request->gambar;
        $soal->pilihan_a=$request->pilihan_a;
        $soal->pilihan_b=$request->pilihan_b;
        $soal->pilihan_c=$request->pilihan_c;
        $soal->pilihan_d=$request->pilihan_d;
        $soal->save();

        return redirect()->route('soal.index')
            ->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(soal $soal)
    {
        return view('admin.soal.edit',[
            'soal'=>$soal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        soal::where('id',$id)
            ->update([
                'jenis_soal'=>$request->jenis_soal,
                'pertanyaan'=>$request->pertanyaan,
                'gambar'=>$request->gambar,
                'pilihan_a'=>$request->pilihan_a,
                'pilihan_b'=>$request->pilihan_b,
                'pilihan_c'=>$request->pilihan_c,
                'pilihan_d'=>$request->pilihan_d,
            ]);

        return redirect()->route('soal.index')
            ->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(soal $soal)
    {
        $soal->delete();
        return redirect()->route('soal.index')
        ->with('success','Data Berhasil Dihapus');
    }
}
