<?php

namespace App\Http\Controllers\Admin;

use App\Prodi;
use App\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = jadwal::leftJoin('kelas', function($join) {
            $join->on('jadwal.id', '=', 'kelas.id_jadwal');
            })
            ->select('jadwal.id as jadwal_id','id_matkul','id_ruang','semester_ak','tahun_ak','kelas.*')
            ->get();
        return $kelas;
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
        $kelas = new kelas();
        $kelas->id_jadwal=$request->id_jadwal;
        $kelas->nm_kelas=$request->nm_kelas;
        $kelas->kuota=$request->kuota;
        $kelas->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $prodi=Prodi::find($id);
        $param=jadwal::where('id_prodi',$id)->orderByDesc('tahun_ak')->get();

        $kelas = jadwal::leftJoin('kelas', function($join) {
            $join->on('jadwal.id', '=', 'kelas.id_jadwal');
            })
            ->select('jadwal.id as jadwal_id','hari','id_matkul','id_ruang','id_prodi','semester_ak','tahun_ak','kelas.*')
            ->where('id_prodi',$id)
            ->where('semester_ak',$request->semester_ak)
            ->where('tahun_ak',$request->tahun_ak)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.kelas.data', [
                'kelas'=>$kelas,
            ]);
            return $view;
        } 
        return view('admin.kelas.index', [
            'kelas'=>$kelas,
            'prodi'=>$prodi,
            'param'=>$param,
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
        $kelas=kelas::find($id);
        return $kelas;
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
        kelas::where('id',$id)
            ->update([
                'id_jadwal'=>$request->id_jadwal,
                'nm_kelas'=>$request->nm_kelas,
                'kuota'=>$request->kuota,
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
        kelas::destroy($id);
    }
}
