<?php

namespace App\Http\Controllers\Admin;

use App\tool;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ToolController extends Controller
{
    private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tool=tool::all();
        // return $jadwal;
        
        if ($request->ajax()) {
            $view = view('admin.tool.data', [
                'tool'=>$tool,
            ]);
            return $view;
        } 
        return view('admin.tool.index');
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

        if ($request->hasFile('foto_tool')) {
            $name = time().'.'. $request->foto_tool->getClientOriginalExtension();
            $foto_tool=$request->foto_tool->move( public_path() . '/images/tool/', $name);
            $simpanFoto='images/tool/'.$name;
        }else {
            $simpanFoto='images/Tidak Ada.jpg';
        }

        $data = tool::create([
            'id'=>$id_user,
            'nm_tool'=>$request->nm_tool,
            'id_prodi'=>$request->id_prodi,
            'username'=>$request->username,
            'password'=>$password,
            'jenkel'=>$request->jenkel,
            'jabatan'=>$request->jabatan,
            'alamat'=>$request->alamat,
            'foto_tool'=>$simpanFoto,
        ]);

        $user = User::create([
            'id'=>$id_user,
            'username'=>$request->username,
            'email' => $request->username,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($request->jabatan);
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
        $tool = tool::find($id);
        return $tool;
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
        tool::where('id',$id)
            ->update([
                'nm_tool'=>$request->nm_tool,
                'id_prodi'=>$request->id_prodi,
                'username'=>$request->username,
                'jenkel'=>$request->jenkel,
                'alamat'=>$request->alamat,
            ]);
        User::where('id',$id)
            ->update([
                'username'=>$request->username,
                'email'=>$request->username,
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
        $role= $user->removeRole($user->tool->jabatan);
        tool::destroy($id); 
        User::destroy($user->id);
    }
}
