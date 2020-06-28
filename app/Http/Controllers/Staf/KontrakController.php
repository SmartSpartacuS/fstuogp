<?php

namespace App\Http\Controllers\Staf;

use App\jadwal;
use App\Mydb\krs;
use App\perwalian;
use App\Mydb\kontrak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class KontrakController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $krs=krs::all();
        $perwalian=perwalian::with('mhs')->get()->where('mhs.id_prodi',auth()->user()->tool->id_prodi);
        $matkul=jadwal::where('id_prodi',auth()->user()->tool->id_prodi)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();
        // return $perwalian;
        // $dosen=dosen::orderBy('nm_dosen')->where('Status','Tetap')->where('prodi_id',auth()->user()->tool->id_prodi)->get();
        
        if ($request->ajax()) {
            $view = view('pekerja.staf.kontrak.data', [
                'krs'=>$krs,
            ]);
            return $view;
        } 
        return view('pekerja.staf.kontrak.index', [
            'krs'=>$krs,
            'perwalian'=>$perwalian,
            'matkul'=>$matkul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $matkul=jadwal::with(['matkul'=>function($orderMatkul){
        //     $orderMatkul->orderBy('nm_matkul');
        // }])->where('id_prodi',auth()->user()->tool->id_prodi)->get();
        // return $matkul;
        
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
            'perwalian_id'=>'required|unique:krs',
        ],[
            'perwalian_id.unique'=>'Data Sudah ada',
        ]);

        $krs = krs::create([
            'perwalian_id'=>$request->perwalian_id,
            'semester_ak'=>$request->semester_ak,
            'tahun_ak'=>$request->tahun_ak,
            'tgl_krs'=>$request->tgl_krs,
        ]);
        $krs_id=krs::latest()->first();
        // return $krs_id->id;

        $data = $request->all();
        // return $data['jadwal_id'];

        foreach ($data['jadwal_id'] as $index => $val) {
            kontrak::create([
                'krs_id' => $krs_id->id,
                'jadwal_id' => $val,
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $krs=krs::find($id);
        $kontrak=kontrak::with(['jadwal'=>function($jadwal){
            $jadwal->with('matkul');
        }])
            ->where('krs_id',$id)->get();

        return Response::json(array(
            'krs' => $krs,
            'kontrak' => $kontrak,
            'mhs' => $krs->perwalian->mhs,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $krs=krs::with('mhs')->find($id);
        // return $krs;
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
        krs::find($id)
            ->update([
                'semester_ak'=>$request->semester_ak,
                'tahun_ak'=>$request->tahun_ak,
                'tgl_krs'=>$request->tgl_krs,
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
        krs::destroy($id);
    }
}
