<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('staf');
Route::resource('StafMhs', 'MhsController');

Route::resource('StafPerwalian', 'PerwalianController');
Route::get('StafPerwalian_mhs', 'PerwalianController@mhs')->name('staf.mhs');

Route::resource('StafJadwal', 'JadwalController');
Route::resource('StafProfile', 'ProfileController');