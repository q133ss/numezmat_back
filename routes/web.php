<?php

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

//Директивы @role и @can!!!!

Route::get('/', function () {
    return view('index');
});

Route::post('/news/block', [App\Http\Controllers\NewsController::class, 'block']);
Route::resource('news', App\Http\Controllers\NewsController::class);
Route::get('rating/detail/{id}', [App\Http\Controllers\RatingController::class, 'detail'])->name('rating.detail');
Route::post('/rating/change-file', [App\Http\Controllers\RatingController::class, 'updateImg']);
Route::post('/rating/delete-file', [App\Http\Controllers\RatingController::class, 'deleteImg']);
Route::resource('rating', App\Http\Controllers\RatingController::class);
Route::view('expertise', 'expertise')->name('expertise.index');
Route::view('catalog', 'catalog.index')->name('catalog.index');
Route::view('catalog/{id}', 'catalog.show')->name('catalog.show');
Route::view('cart', 'cart')->name('cart.index');
Route::view('search', 'search')->name('search');
Route::post('/comment/send', [App\Http\Controllers\CommentController::class, 'sendComment'])->name('comment.send');
Route::post('/comment/action', [App\Http\Controllers\CommentController::class, 'actionComment'])->name('comment.action');

Auth::routes();
