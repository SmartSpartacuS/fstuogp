<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\prodi;
use App\mhs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class mhsController extends Controller
{
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
    public function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->generate_string($this->permitted_chars, 8);
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
        $password= $this->generate_string($this->permitted_chars, 8);
        $id_user= User::orderByDesc('id')->first()->id+1;
        $mhs = new mhs;
        $mhs->id=$id_user;
        $mhs->NPM=$request->NPM;
        $mhs->id_prodi=$request->id_prodi;
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
     * @param  \App\mhs  $mhs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $prodi=Prodi::find($id);
        $mhs= mhs::where('id_prodi',$id)
            ->orderBy('NPM')
            ->get();

        // return $mhs;
        
        if ($request->ajax()) {
            $view = view('admin.mhs.data', [
                'mhs'=>$mhs,
            ]);
            return $view;
        } 
        return view('admin.mhs.index', [
            'mhs'=>$mhs,
            'prodi'=>$prodi,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mhs  $mhs
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
     * @param  \App\mhs  $mhs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        mhs::where('id',$id)
            ->update([
                'NPM'=>$request->NPM,
                'id_prodi'=>$request->id_prodi,
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
     * @param  \App\mhs  $mhs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mhs::destroy($id);
        User::destroy($id);
    }
}
