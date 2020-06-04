<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('staf');
Route::resource('StafMhs', 'MhsController');
Route::resource('StafPerwalian', 'PerwalianController');
Route::resource('StafJadwal', 'JadwalController');
Route::resource('StafProfile', 'ProfileController');