<?php

namespace App\Http\Controllers\Kaprodi;

use App\User;
use App\dosen;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosen=dosen::find(auth()->user()->id);
        
        if ($request->ajax()) {
            $view = view('pekerja.kaprodi.profile.data', [
                'dosen'=>$dosen,
            ]);
            return $view;
        } 
        return view('pekerja.kaprodi.profile.index', [
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
        $request->validate([
            'password_lama' => ['required', new MatchOldPassword],
            'password_baru' => ['required'],
            'confirm_password' => ['same:password_baru'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password_baru)]);

        $dosen=dosen::find(auth()->user()->id)
            ->update([
                'password'=>$request->password_baru,
            ]);
        return redirect()->route('kaprodiProfile.index')
            ->with('success','Berhasil Merubah Password');
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
        //
    }
}
