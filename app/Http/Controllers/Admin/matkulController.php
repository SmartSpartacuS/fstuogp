<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\prodi;
use App\matkul;
use Illuminate\Http\Request;

class matkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $matkul=matkul::all();
        $prodi = prodi::orderBy('nm_prodi')->get();
        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.matkul.data', [
                'matkul'=>$matkul,
            ]);
            return $view;
        } 
        return view('admin.matkul.index',[
            'prodi'=>$prodi,
        ]);
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
            'kd_matkul'=>'required|unique:matkul|max:10',
            'nm_matkul'=>'required',
            'sks'=>'required',
            'semester'=>'required',
        ],[
            'kd_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'kd_matkul.max'=>'Karakternya Kelebihan Woyy',
            'kd_matkul.unique'=>'Kode matkul Sudah ada',
            'nm_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'sks.required'=>'Tidak Boleh Kosong Woyy',
            'semester.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        $matkul = new matkul;
        $matkul->kd_matkul=$request->kd_matkul;
        $matkul->id_prodi=$request->id_prodi;
        $matkul->nm_matkul=$request->nm_matkul;
        $matkul->sks=$request->sks;
        $matkul->semester=$request->semester;
        $matkul->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function show(matkul $matkul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matkul = matkul::find($id);
        return $matkul;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, matkul $matkul)
    {
        $this->validate($request,[
            'kd_matkul'=>'required|max:10',
            'id_prodi'=>'required|max:4',
            'nm_matkul'=>'required',
            'sks'=>'required',
            'semester'=>'required',
        ],[
            'kd_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'kd_matkul.max'=>'Karakternya Kelebihan Woyy',
            'id_prodi.required'=>'Tidak Boleh Kosong Woyy',
            'id_prodi.max'=>'Karakternya Kelebihan Woyy',
            'nm_matkul.required'=>'Tidak Boleh Kosong Woyy',
            'sks.required'=>'Tidak Boleh Kosong Woyy',
            'semester.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        matkul::where('id',$matkul->id)
            ->update([
                'kd_matkul'=>$request->kd_matkul,
                'id_prodi'=>$request->id_prodi,
                'nm_matkul'=>$request->nm_matkul,
                'sks'=>$request->sks,
                'semester'=>$request->semester,
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\matkul  $matkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(matkul $matkul)
    {
        $matkul->delete();
    }
}
