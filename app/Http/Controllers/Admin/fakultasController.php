<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\fakultas;
use Illuminate\Http\Request;

class fakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = fakultas::all();
        return view ('admin.fakultas.index',['fakultas'=>$fakultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.fakultas.create');
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
            'kd_fakultas'=>'required|unique:fakultas|max:4',
            'nm_fakultas'=>'required',
        ],[
            'kd_fakultas.required'=>'Tidak Boleh Kosong Woyy',
            'kd_fakultas.max'=>'Karakternya Kelebihan Woyy',
            'nm_fakultas.required'=>'Tidak Boleh Kosong Woyy',
            'kd_fakultas.unique'=>'Kode Fakultas Sudah ada',
        ]);
        $fakultas = new fakultas;
        $fakultas->kd_fakultas=$request->kd_fakultas;
        $fakultas->nm_fakultas=$request->nm_fakultas;
        $fakultas->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit(fakultas $fakulta)
    {
        // dd($fakulta);
        return view('admin.fakultas.edit',[
            'fakultas'=>$fakulta,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fakultas $fakulta)
    {
        $this->validate($request,[
            'kd_fakultas'=>'required|max:4',
            'nm_fakultas'=>'required',
        ],[
            'kd_fakultas.required'=>'Tidak Boleh Kosong Woyy',
            'kd_fakultas.max'=>'Karakternya Kelebihan Woyy',
            'nm_fakultas.required'=>'Tidak Boleh Kosong Woyy',
        ]);

        fakultas::where('id',$fakulta->id)
            ->update([
                'kd_fakultas'=>$request->kd_fakultas,
                'nm_fakultas'=>$request->nm_fakultas,
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy(fakultas $fakulta)
    {
        $fakulta->delete();
    }
}
