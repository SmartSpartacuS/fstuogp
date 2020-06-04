<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ruang;
use Illuminate\Http\Request;

class ruangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ruang=ruang::all();
        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.ruang.data', [
                'ruang'=>$ruang,
            ]);
            return $view;
        } 
        return view('admin.ruang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kd_ruang'=>'required|unique:ruang|max:10',
            'nm_ruang'=>'required',
        ]);
        $ruang = new ruang;
        $ruang->kd_ruang=$request->kd_ruang;
        $ruang->nm_ruang=$request->nm_ruang; 
        $ruang->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show(ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruang=ruang::find($id);
        return $ruang;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ruang $ruang)
    {
        $this->validate($request,[
            'kd_ruang'=>'required|max:10',
            'nm_ruang'=>'required',
        ],[
            'kd_ruang.required'=>'Tidak Boleh Kosong Woyy',
            'kd_ruang.max'=>'Karakternya Kelebihan Woyy',
            'nm_ruang.required'=>'Tidak Boleh Kosong Woyy',
        ]);

        ruang::where('id',$ruang->id)
            ->update([
                'kd_ruang'=>$request->kd_ruang,
                'nm_ruang'=>$request->nm_ruang,
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ruang $ruang)
    {
        $ruang->delete();
    }
}
