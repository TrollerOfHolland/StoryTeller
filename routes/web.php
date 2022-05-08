<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/gyik', function () {
    return view('gyik');
});

Route::get('/create_book', function () {
    return view('create_book');
});
