<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\prodi;
use App\fakultas;
use Illuminate\Http\Request;

class prodiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = prodi::with('fakultas')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prodi.create',[
            'fakultas'=> fakultas::orderBy('kd_fakultas','ASC')->get(),
        ]);
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
            'kd_prodi'=>'required|unique:prodi|max:4',
            'kd_fakultas'=>'required|max:4',
            'nm_prodi'=>'required',
        ],[
            'kd_prodi.required'=>'Tidak Boleh Kosong Woyy',
            'kd_prodi.max'=>'Karakternya Kelebihan Woyy',
            'kd_prodi.unique'=>'Kode Prodi Sudah ada',
            'kd_fakultas.required'=>'Tidak Boleh Kosong Woyy',
            'kd_fakultas.max'=>'Karakternya Kelebihan Woyy',
            'nm_prodi.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        $prodi = new prodi;
        $prodi->kd_prodi=$request->kd_prodi;
        $prodi->kd_fakultas=$request->kd_fakultas;
        $prodi->nm_prodi=$request->nm_prodi;
        $prodi->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(prodi $prodi)
    {
        return view('admin.prodi.edit',[
            'prodi'=>$prodi,
            'fakultas'=> fakultas::orderBy('nm_fakultas','ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prodi $prodi)
    {
        $this->validate($request,[
            'kd_prodi'=>'required|max:4',
            'kd_fakultas'=>'required|max:4',
            'nm_prodi'=>'required',
        ],[
            'kd_prodi.required'=>'Tidak Boleh Kosong Woyy',
            'kd_prodi.max'=>'Karakternya Kelebihan Woyy',
            'kd_fakultas.required'=>'Tidak Boleh Kosong Woyy',
            'kd_fakultas.max'=>'Karakternya Kelebihan Woyy',
            'nm_prodi.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        prodi::where('id',$prodi->id)
            ->update([
                'kd_prodi'=>$request->kd_prodi,
                'kd_fakultas'=>$request->kd_fakultas,
                'nm_prodi'=>$request->nm_prodi,
            ]);

        return redirect()->route('prodi.index')
            ->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(prodi $prodi)
    {
        $prodi->delete();
    }
}
