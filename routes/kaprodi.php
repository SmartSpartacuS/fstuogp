<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('kaprodi');

Route::resource('kaprodiJadwal', 'JadwalController');
Route::post('exportExcelPerProdi', 'JadwalController@exportExcelPerProdi')->name('exportExcelPerProdi');

Route::resource('kaprodiDosen', 'DosenController');
Route::resource('kaprodiProfile', 'ProfileController');