<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dosen');
Route::get('/testing', 'DashboardController@testing')->name('testing');