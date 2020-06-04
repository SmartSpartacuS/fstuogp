<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\jadwal;
use App\prodi;
use App\matkul;
use App\ruang;
use App\dosen;
use App\Exports\JadwalExport;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $jadwal = new jadwal;
        $jadwal->id_prodi=$request->id_prodi;
        $jadwal->id_matkul=$request->id_matkul;
        $jadwal->id_ruang=$request->id_ruang;
        $jadwal->id_dosen=$request->id_dosen;
        $jadwal->hari=$request->hari;
        $jadwal->jam_mulai=$request->jam_mulai;
        $jadwal->jam_seles=$request->jam_seles;
        $jadwal->semester_ak=$request->semester_ak;
        $jadwal->tahun_ak=$request->tahun_ak;
        $jadwal->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
       
        $prodi=Prodi::find($id);
        $matkul=matkul::where('id_prodi',$id)->get();
        $dosen=dosen::orderBy('nm_dosen')->get();
        $ruang=ruang::orderBy('nm_ruang')->get();
        $param=jadwal::where('id_prodi',$id)->orderByDesc('tahun_ak')->get();
        $jadwal= jadwal::where('id_prodi',$id)
            ->where('semester_ak',$request->semester_ak)
            ->where('tahun_ak',$request->tahun_ak)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.jadwal_perprodi.data', [
                'jadwal'=>$jadwal,
            ]);
            return $view;
        } 
        return view('admin.jadwal_perprodi.index', [
            'jadwal'=>$jadwal,
            'prodi'=>$prodi,
            'param'=>$param,
            'matkul'=>$matkul,
            'dosen'=>$dosen,
            'ruang'=>$ruang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = jadwal::find($id);
        return $jadwal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jadwal $jadwal)
    {

        jadwal::where('id',$jadwal->id)
            ->update([
                'id_prodi'=>$request->id_prodi,
                'id_matkul'=>$request->id_matkul,
                'id_ruang'=>$request->id_ruang,
                'id_dosen'=>$request->id_dosen,
                'hari'=>$request->hari,
                'jam_mulai'=>$request->jam_mulai,
                'jam_seles'=>$request->jam_seles,
                'semester_ak'=>$request->semester_ak,
                'tahun_ak'=>$request->tahun_ak,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $jadwal)
    {
        $jadwal->delete();
    }

    public function export(Request $request) 
    {
        return Excel::download(new JadwalExport($request->id_prodi,$request->semester_ak,$request->tahun_ak), 'Jadwal.xlsx');
    }
}
