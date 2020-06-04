<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\aktif;
use App\mulaiJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class aktifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aktif = mulaiJawab::orderByDesc('id')->get();
        return view ('admin.aktif.index',[
            'aktif'=>$aktif,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\aktif  $aktif
     * @return \Illuminate\Http\Response
     */
    public function show(aktif $aktif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\aktif  $aktif
     * @return \Illuminate\Http\Response
     */
    public function edit(aktif $aktif)
    {
        return view('admin.aktif.edit',[
            'aktif'=>$aktif,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\aktif  $aktif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, aktif $aktif)
    {
        aktif::where('id',$aktif->id)
            ->update([
                'status'=>$request->status,
            ]);

        return redirect()->route('aktif.index')
            ->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\aktif  $aktif
     * @return \Illuminate\Http\Response
     */
    public function destroy(aktif $aktif)
    {
        //
    }
}
