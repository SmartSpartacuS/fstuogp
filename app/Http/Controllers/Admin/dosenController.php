<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\mhsController;

class dosenController extends Controller
{
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosen=dosen::all();
        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.dosen.data', [
                'dosen'=>$dosen,
            ]);
            return $view;
        } 
        return view('admin.dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password=app('App\Http\Controllers\Admin\mhsController')->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;
 
        $this->validate($request,[
            'NIDN'=>'required|unique:dosen|max:18',
            'nm_dosen'=>'required',
            'jenkel'=>'required',
            'alamat'=>'required',
        ],[
            'NIDN.required'=>'Tidak Boleh Kosong Woyy',
            'NIDN.max'=>'Karakternya Kelebihan Woyy',
            'NIDN.unique'=>'NIDN Sudah ada',
            'nm_dosen.required'=>'Tidak Boleh Kosong Woyy',
            'jenkel.required'=>'Tidak Boleh Kosong Woyy',
            'alamat.required'=>'Tidak Boleh Kosong Woyy',
        ]);
        $dosen = new dosen;
        $dosen->id=$id_user;
        $dosen->NIDN=$request->NIDN;
        $dosen->nm_dosen=$request->nm_dosen;
        $dosen->id_prodi=$request->id_prodi;
        $dosen->password=$password;
        $dosen->jenkel=$request->jenkel;
        $dosen->status=$request->status;
        $dosen->jabatan=$request->jabatan;
        $dosen->alamat=$request->alamat;
        
        $user= User::create([
            'id' => $id_user,
            'username' => $request['NIDN'],
            'email' => $request['NIDN'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole($request->jabatan);

        $dosen->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = dosen::find($id);
        return $dosen;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'NIDN'=>'required|max:18',
            'nm_dosen'=>'required',
            'jenkel'=>'required',
            'alamat'=>'required',
        ],[
            'NIDN.required'=>'Tidak Boleh Kosong Woyy',
            'NIDN.max'=>'Karakternya Kelebihan Woyy',
            'nm_dosen.required'=>'Tidak Boleh Kosong Woyy',
            'jenkel.required'=>'Tidak Boleh Kosong Woyy',
            'alamat.required'=>'Tidak Boleh Kosong Woyy',
        ]);

        dosen::where('id',$id)
            ->update([
                'NIDN'=>$request->NIDN,
                'nm_dosen'=>$request->nm_dosen,
                'jenkel'=>$request->jenkel,
                'id_prodi'=>$request->id_prodi,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
            ->update([
                'username'=>$request->NIDN,
                'email'=>$request->NIDN,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cari=dosen::find($id);
        $user=User::find($id);
        $role= $user->removeRole($cari->jabatan);
        dosen::destroy($id);
        User::destroy($user->id);
    }
}
