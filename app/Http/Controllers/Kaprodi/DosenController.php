<?php

namespace App\Http\Controllers\Kaprodi;

use App\User;
use App\dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosen=dosen::where('id_prodi',auth()->user()->dosen->id_prodi)
            ->whereNotIn('id', [auth()->user()->dosen->id])
            ->get();

        // return $dosen;
        
        if ($request->ajax()) {
            $view = view('pekerja.kaprodi.dosen.data', [
                'dosen'=>$dosen,
            ]);
            return $view;
        } 
        return view('pekerja.kaprodi.dosen.index', [
            'dosen'=>$dosen,
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

        $data = dosen::create([
            'id'=>$id_user,
            'NIDN'=>$request->NIDN,
            'nm_dosen'=>$request->nm_dosen,
            'id_prodi'=>auth()->user()->dosen->id_prodi,
            'password'=>$request->password,
            'jenkel'=>$request->jenkel,
            'status'=>$request->status,
            'jabatan'=>'Dosen',
            'alamat'=>$request->alamat,
        ]);

        
        $user= User::create([
            'id' => $id_user,
            'username' => $request->NIDN,
            'email' => $request->NIDN,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Dosen');

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
        $dosen = dosen::find($id);
        return $dosen;
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

        dosen::find($id)
            ->update([
                'NIDN'=>$request->NIDN,
                'nm_dosen'=>$request->nm_dosen,
                'jenkel'=>$request->jenkel,
                'status'=>$request->status,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
        ->update([
            'username' => $request->NIDN,
            'email' => $request->NIDN,
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
        $cari=dosen::find($id);
        $user=User::find($id);
        $role= $user->removeRole('Dosen');
        dosen::destroy($id);
        User::destroy($user->id);
    }
}
