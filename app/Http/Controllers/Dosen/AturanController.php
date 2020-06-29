<?php

namespace App\Http\Controllers\Dosen;

use App\jadwal;
use App\Mydb\aturan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AturanController extends Controller
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
        $waktu=  $request->waktu;

        // echo $waktu."<br><br><br>";
        $potongMulai=substr($waktu,0,10) ." ".substr($waktu,11,5);
        $potongSeles=substr($waktu,19,10) ." ".substr($waktu,-5);

        $waktuMulai= Carbon::createFromFormat('d/m/Y H:i', $potongMulai)->toDateTimeString();
        $waktuSeles= Carbon::createFromFormat('d/m/Y H:i', $potongSeles)->toDateTimeString();


        $data = aturan::create([
            'jadwal_id'=>$request->jadwal_id,
            'tujuan_event_id'=>2,
            'jenis_tujuan'=>"$request->jenis_tujuan",
            'aturan_mulai'=>$waktuMulai,
            'aturan_seles'=>$waktuSeles,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // $prodi=Prodi::find($id);
        $aturan= aturan::with('jadwal')
            ->where('jadwal_id',$id)->get()->where('jadwal.id_dosen',auth()->user()->id)->first();
        $jadwal=jadwal::find($id);

        return $aturan;

        
        if ($request->ajax()) {
            $view = view('pekerja.dosen.aturan.data', [
                'aturan'=>$aturan,
            ]);
            return $view;
        } 
        return view('pekerja.dosen.aturan.index', [
            'jadwal'=>$jadwal,
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
        $data=aturan::find($id);

        return view('pekerja.dosen.soal.ubah',[
            'aturan'=>$data,
        ]);
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
        $waktu=  $request->waktu;

        // echo $waktu."<br><br><br>";
        $potongMulai=substr($waktu,0,10) ." ".substr($waktu,11,5);
        $potongSeles=substr($waktu,19,10) ." ".substr($waktu,-5);

        $waktuMulai= Carbon::createFromFormat('d/m/Y H:i', $potongMulai)->toDateTimeString();
        $waktuSeles= Carbon::createFromFormat('d/m/Y H:i', $potongSeles)->toDateTimeString();


        aturan::find($id)
        ->update([
            'jadwal_id'=>$request->jadwal_id,
            'tujuan_event_id'=>2,
            'jenis_tujuan'=>"$request->jenis_tujuan",
            'aturan_mulai'=>$waktuMulai,
            'aturan_seles'=>$waktuSeles,
        ]);

        $data=jadwal::find($request->jadwal_id);

        return redirect()->route('soalDosen.show',$data->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        aturan::destroy($id);
        return redirect()->back(); 
    }
}
