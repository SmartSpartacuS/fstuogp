<?php 

use Illuminate\Support\Facades\Route;

Route::get('/','dashboardController@index')
    ->name('mhs');

Route::resource('mulaiJawab', 'mulaiJawabController');

Route::get('soal', 'soalController@tampil')->name('tampilSoal');

Route::resource('jawaban', 'jawabanController'); 