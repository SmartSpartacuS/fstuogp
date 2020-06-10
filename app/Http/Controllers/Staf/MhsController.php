<?php

namespace App\Http\Controllers\Staf;

use App\mhs;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MhsController extends Controller
{
    private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mhs=mhs::where('id_prodi',auth()->user()->staf->id_prodi)->get();

        // return $mhs;
        
        if ($request->ajax()) {
            $view = view('pekerja.staf.mhs.data', [
                'mhs'=>$mhs,
            ]);
            return $view;
        } 
        return view('pekerja.staf.mhs.index', [
            'mhs'=>$mhs,
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
        $this->validate($request,[
            'NPM'=>'required|unique:mhs|min:6|max:6',
        ],[
            'NPM.unique'=>'NPM Sudah ada',
        ]);
        
        $password=app('App\Http\Controllers\Admin\mhsController')->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;

        $mhs = new mhs;
        $mhs->id=$id_user;
        $mhs->NPM=$request->NPM;
        $mhs->id_prodi=auth()->user()->staf->id_prodi;
        $mhs->nm_mhs=$request->nm_mhs;
        $mhs->password=$password;
        $mhs->jenkel=$request->jenkel;
        $mhs->angkatan=$request->angkatan;
        $mhs->alamat=$request->alamat;
        $mhs->save();

        $user= User::create([
            'id' => $id_user,
            'username' => $request['NPM'],
            'email' => $request['NPM'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Mahasiswa'); 
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
        $mhs=mhs::find($id);
        return $mhs;
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
        mhs::where('id',$id)
            ->update([
                'NPM'=>$request->NPM,
                'id_prodi'=>auth()->user()->staf->id_prodi,
                'nm_mhs'=>$request->nm_mhs,
                'jenkel'=>$request->jenkel,
                'angkatan'=>$request->angkatan,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
        ->update([
            'username' => $request['NPM'],
            'email' => $request['NPM'],
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
        $user=User::find($id);
        $role= $user->removeRole('Mahasiswa');
        mhs::destroy($id);
        User::destroy($user->id);
    }
}
