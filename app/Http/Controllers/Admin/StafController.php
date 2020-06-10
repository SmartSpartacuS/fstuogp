<?php

namespace App\Http\Controllers\Admin;

use App\Staf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class StafController extends Controller
{
    private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staf=Staf::all();
        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.staf.data', [
                'staf'=>$staf,
            ]);
            return $view;
        } 
        return view('admin.staf.index');
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

        $data = Staf::create([
            'id'=>$id_user,
            'nm_staf'=>$request->nm_staf,
            'id_prodi'=>$request->id_prodi,
            'username'=>$request->username,
            'password'=>$password,
            'jenkel'=>$request->jenkel,
            'alamat'=>$request->alamat,
        ]);

        $user = User::create([
            'id'=>$id_user,
            'username'=>$request->username,
            'email' => $request->username,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Staf');
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
        //
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
        //
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
        $role= $user->removeRole('Staf');
        Staf::destroy($id);
        User::destroy($user->id);
    }
}
