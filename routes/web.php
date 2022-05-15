<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/notice', function () {
    return view('verification.notice');
});

Route::get('/gyik', function () {
    return view('gyik');
});

/*
|--------------------------------------------------------------------------
| Library routes
|--------------------------------------------------------------------------
|
*/
Route::resource('books', BookController::class);

Route::get('read', [BookController::class, 'read'])->name('books.read');

/*
Route::get('/create_story', function () {
    return view('library.create_story');
});

Route::get('all_books', [BookController::class, 'all_books'])->name('library.all_books');
Route::get('my_books', [BookController::class, 'my_books'])->name('library.my_books');
Route::get('create_book', [BookController::class, 'store'])->name('library.create_book');

Route::get('/all_stories', function () {
    return view('library.all_stories');
});

Route::get('/my_stories', function () {
    return view('library.my_stories');
});*/

/*
|--------------------------------------------------------------------------
| Verification routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/email/verify', '\App\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', '\App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', '\App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');
});
Route::group(['middleware' => ['auth','verified']], function() {
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@index');
});

