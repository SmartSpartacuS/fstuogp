<?php

namespace App\Http\Controllers\Dosen;

use App\jadwal;
use App\Mydb\aturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mydb\soal;

class SoalController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $aturan= aturan::with('jadwal')
            ->where('jadwal_id',$id)->get()->where('jadwal.id_dosen',auth()->user()->id)->first();

        $jadwal=jadwal::find($id);

        // $soal=soal::with('aturan')->get();

        // return $aturan;

        
        if ($request->ajax()) {
            $view = view('pekerja.dosen.soal.data', [
                'aturan'=>$aturan,
            ]);
            return $view;
        } 
        return view('pekerja.dosen.soal.index', [
            'jadwal'=>$jadwal,
            'aturan'=>$aturan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
