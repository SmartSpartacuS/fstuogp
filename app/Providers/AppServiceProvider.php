<?php

namespace App\Providers;

use App\dosen;
use App\prodi;
use Maatwebsite\Excel\Sheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sheet::macro('horizontalAlign', function (Sheet $sheet, string $cellRange, string $align) {
            $sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal($align);
        });
        Sheet::macro('setFontFamily', function (Sheet $sheet, string $cellRange, string $font) {
            $sheet->getDelegate()->getStyle($cellRange)->getFont()->setName($font);
        });
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });

        $allProdi = prodi::all();
        view()->share('allProdi', $allProdi);

        //compose all the views....
        view()->composer('*', function ($view) 
        {
            if (Auth::check()){
                $matkul= dosen::with(['jadwal'=>function($jadwal){
                    $jadwal->with('matkul');
                }])->where('id',Auth::user()->id)->get();
            //...with this variable
            $view->with('menuMatkul', $matkul);
            }    
        });  
    }
}
