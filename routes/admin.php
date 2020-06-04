<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('admin');
Route::resource('fakultas', 'fakultasController');
Route::resource('prodi', 'prodiController');
Route::resource('matkul', 'matkulController');
Route::resource('ruang', 'ruangController');
Route::resource('dosen', 'dosenController');
Route::resource('mhs', 'mhsController');
Route::resource('kelas', 'KelasController');

Route::resource('jadwal', 'jadwalController');
Route::get('jadwalPerProdi/{id}', 'jadwalController@jadwalPerProdi')->name('jadwalPerProdi');
Route::post('jadwalExport', 'jadwalController@export')->name('jadwalExport');

Route::resource('staf', 'StafController');

Route::resource('aktif', 'aktifController');
Route::resource('soal', 'soalController');

Route::get('semuaJawaban', 'jawabanController@semuaJawaban')->name('semuaJawaban');
Route::get('jawabanMhs/{npm}', 'jawabanController@jawabanMhs')->name('jawabanMhs'); 
