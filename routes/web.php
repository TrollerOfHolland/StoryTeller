<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\StoryRatingController;

/*
|--------------------------------------------------------------------------
| Basic routes
|--------------------------------------------------------------------------
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
| Book & Story routes
|--------------------------------------------------------------------------
|
*/
Route::resource('books', BookController::class);
Route::resource('ratings', RatingController::class);
Route::resource('stories', StoryController::class);
Route::resource('nodes', NodeController::class);
Route::resource('story_ratings', StoryRatingController::class);

Route::get('readStory/{id}', [StoryController::class, 'readStory'])->name('stories.readStory');

Route::get('getStory/{id}', [StoryController::class, 'getStory'])->name('stories.getStory');

Route::get('addToOwnedStories/{id}', [StoryController::class, 'addToOwnedStories'])->name('stories.addToOwnedStories');

Route::get('addToOwnedBooks/{id}', [BookController::class, 'addToOwnedBooks'])->name('books.addToOwnedBooks');

Route::get('read/{id}', [BookController::class, 'read'])->name('books.read');

Route::get('download/{id}', [BookController::class, 'download'])->name('books.download');

Route::get('create/{id}', [NodeController::class, 'create'])->name('nodes.create');

Route::get('end/{id}', [NodeController::class, 'end'])->name('nodes.end');

Route::get('getFixpointWithoutDelete/{id}', [NodeController::class, 'getFixpointWithoutDelete'])->name('nodes.getFixpointWithoutDelete');

Route::get('destroy/{id}', [NodeController::class, 'destroy'])->name('nodes.destroy');



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

