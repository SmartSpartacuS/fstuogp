<?php

namespace App\Http\Controllers\Kaprodi;

use App\dosen;
use App\ruang;
use App\jadwal;
use App\matkul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JadwalExport;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $matkul=matkul::orderBy('nm_matkul')->get();
        $dosen=dosen::orderBy('nm_dosen')->where('id_prodi',auth()->user()->dosen->id_prodi)->get();
        $ruang=ruang::orderBy('nm_ruang')->get();
        $param=jadwal::where('id_prodi',auth()->user()->dosen->id_prodi)->orderByDesc('tahun_ak')->get();

        $jadwal= jadwal::where('id_prodi',auth()->user()->dosen->id_prodi)
            ->where('semester_ak',$request->semester_ak)
            ->where('tahun_ak',$request->tahun_ak)
            ->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();

        // return $jadwal;
        $prodi=auth()->user()->dosen->id_prodi;
        if ($request->ajax()) {
            $view = view('pekerja.kaprodi.jadwal.data', [
                'jadwal'=>$jadwal,
                'prodi'=>$prodi
            ]);
            return $view;
        } 
        return view('pekerja.kaprodi.jadwal.index', [
            'jadwal'=>$jadwal,
            'param'=>$param,
            'matkul'=>$matkul,
            'dosen'=>$dosen,
            'ruang'=>$ruang,
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

        $data = jadwal::create([
            'id_prodi'=>auth()->user()->dosen->id_prodi,
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
        $jadwal = jadwal::find($id);
        return $jadwal;
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
        jadwal::where('id',$id)
            ->update([
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jadwal::destroy($id);
    }


    public function exportExcelPerProdi(Request $request) 
    {
        
        if ($request->id_prodi) {
            $prodi=auth()->user()->dosen->prodi->nm_prodi;
        }else{
            $prodi="FST";
        }
        
        return Excel::download(new JadwalExport($request->id_prodi,$request->semester_ak,$request->tahun_ak), "JADWAL $prodi $request->tahun_ak $request->semester_ak.xlsx");

    }
}
