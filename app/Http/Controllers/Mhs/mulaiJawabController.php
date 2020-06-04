<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use App\mulaiJawab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mulaiJawabController extends Controller
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
        $mulaiJawab=mulaiJawab::where('NPM',Auth::user()->username)->first();

        if ($mulaiJawab) {
            return redirect()->route('tampilSoal');
        }

        $carbon=Carbon::now('+09:00');
        $tgl=$carbon->toDateString();
        $jamulai=$carbon->toTimeString();
        $jamseles=$carbon->addMinutes(26)->toTimeString();

        $isian= mulaiJawab::create([
            'NPM' => Auth::user()->username,
            'tgl' => $tgl,
            'mulai' => $jamulai,
            'seles' => $jamseles,
            'status' => 'aktif',
        ]);

        return redirect()->route('tampilSoal');

        // dump($tgl);
        // dump($jamulai);
        // dump($jamseles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mulaiJawab  $mulaiJawab
     * @return \Illuminate\Http\Response
     */
    public function show(mulaiJawab $mulaiJawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mulaiJawab  $mulaiJawab
     * @return \Illuminate\Http\Response
     */
    public function edit(mulaiJawab $mulaiJawab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mulaiJawab  $mulaiJawab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mulaiJawab $mulaiJawab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mulaiJawab  $mulaiJawab
     * @return \Illuminate\Http\Response
     */
    public function destroy(mulaiJawab $mulaiJawab)
    {
        //
    }
}
