<?php

namespace App\Http\Controllers\Staf;

use App\mhs;
use App\dosen;
use App\perwalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perwalian=perwalian::with('mhs')->get()->where('mhs.id_prodi',auth()->user()->tool->id_prodi)->all();
        // return $mhs; 
        
        $dosen=dosen::orderBy('nm_dosen')->where('Status','Tetap')->where('prodi_id',auth()->user()->tool->id_prodi)->get();
        
        if ($request->ajax()) {
            $view = view('pekerja.staf.perwalian.data', [
                'perwalian'=>$perwalian,
            ]);
            return $view;
        } 
        return view('pekerja.staf.perwalian.index', [
            'perwalian'=>$perwalian,
            'dosen'=>$dosen
        ]);
    }

    // JSON untuk mhs
    public function mhs()
    {
        $mhs=mhs::orderByDesc('NPM')
            ->where('id_prodi',auth()->user()->tool->id_prodi)
            ->whereNotIn('id',DB::table('perwalians')->pluck('mhs_id'))
            ->get();
        
        return $mhs;
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
        $data = perwalian::create([
            'dosen_id'=>$request->dosen_id,
            'mhs_id'=>$request->mhs_id,
        ]);
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
    public function edit($id)
    {
        $perwalian=perwalian::with('mhs')->find($id);
        return $perwalian;
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
        perwalian::where('id',$id)
            ->update([
                'dosen_id'=>$request->dosen_id,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        perwalian::destroy($id);
    }
}
