<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dosen');
// Route::get('/testing', 'DashboardController@testing')->name('testing');

Route::resource('aturan', 'AturanController');
Route::resource('soalDosen', 'SoalController');