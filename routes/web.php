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

Route::get('/', function () {
    return view('index');
});

//News
Route::post('/news/block', [App\Http\Controllers\NewsController::class, 'block']);
Route::resource('news', App\Http\Controllers\NewsController::class);

//Rating
Route::get('rating/detail/{id}', [App\Http\Controllers\RatingController::class, 'detail'])->name('rating.detail');
Route::post('/rating/change-file', [App\Http\Controllers\RatingController::class, 'updateImg']);
Route::post('/rating/delete-file', [App\Http\Controllers\RatingController::class, 'deleteImg']);
Route::get('/rating/block/{id}/{action}', [App\Http\Controllers\RatingController::class, 'block'])->name('rating.block');
Route::get('/rating/create-section', [App\Http\Controllers\RatingController::class, 'createSection'])->name('rating.create.section');
Route::post('/rating/store-section', [App\Http\Controllers\RatingController::class, 'storeSection'])->name('rating.store.section');
Route::get('/rating/edit-section/{id}', [App\Http\Controllers\RatingController::class, 'editSection'])->name('rating.edit.section');
Route::post('/rating/update-section/{id}', [App\Http\Controllers\RatingController::class, 'updateSection'])->name('rating.update.section');
Route::get('/rating/delete-section/{id}', [App\Http\Controllers\RatingController::class, 'deleteSection'])->name('rating.delete.section');
Route::resource('rating', App\Http\Controllers\RatingController::class);


Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

//Expertise
Route::get('/expertise/create/section', [App\Http\Controllers\ExpertiseController::class, 'createSection'])->name('expertise.create.section');
Route::post('/expertise/store-section', [App\Http\Controllers\ExpertiseController::class, 'storeSection'])->name('expertise.store.section');
Route::get('expertise/detail/{id}', [App\Http\Controllers\ExpertiseController::class, 'detail'])->name('expertise.detail');
Route::get('/expertise/block/{id}/{action}', [App\Http\Controllers\ExpertiseController::class, 'block'])->name('expertise.block');
Route::get('/expertise/edit-section/{id}', [App\Http\Controllers\ExpertiseController::class, 'editSection'])->name('expertise.edit.section');
Route::post('/expertise/update-section/{id}', [App\Http\Controllers\ExpertiseController::class, 'updateSection'])->name('expertise.update.section');
Route::post('/expertise/change-file', [App\Http\Controllers\ExpertiseController::class, 'updateImg']);
Route::post('/expertise/delete-file', [App\Http\Controllers\ExpertiseController::class, 'deleteImg']);
Route::get('/expertise/delete-section/{id}', [App\Http\Controllers\ExpertiseController::class, 'deleteSection'])->name('expertise.delete.section');
Route::resource('expertise', App\Http\Controllers\ExpertiseController::class);

//Catalog
Route::get('/catalog/create/section', [App\Http\Controllers\CatalogController::class, 'createSection'])->name('catalog.create.section');
Route::post('/catalog/store-section', [App\Http\Controllers\CatalogController::class, 'storeSection'])->name('catalog.store.section');
Route::get('/catalog/edit-section/{id}', [App\Http\Controllers\CatalogController::class, 'editSection'])->name('catalog.edit.section');
Route::post('/catalog/update-section/{id}', [App\Http\Controllers\CatalogController::class, 'updateSection'])->name('catalog.update.section');
Route::get('/catalog/delete-section/{id}', [App\Http\Controllers\CatalogController::class, 'deleteSection'])->name('catalog.delete.section');
Route::post('/catalog/change-file', [App\Http\Controllers\CatalogController::class, 'updateImg']);
Route::post('/catalog/delete-file', [App\Http\Controllers\CatalogController::class, 'deleteImg']);
Route::get('/catalog/block/{id}/{action}', [App\Http\Controllers\CatalogController::class, 'block'])->name('catalog.block');
Route::get('catalog/detail/{id}', [App\Http\Controllers\CatalogController::class, 'detail'])->name('catalog.detail');
Route::get('/catalog/search', [App\Http\Controllers\CatalogController::class, 'search'])->name('catalog.search');
Route::resource('catalog', App\Http\Controllers\CatalogController::class);


//Shop
Route::get('/shop/create/section', [App\Http\Controllers\ShopController::class, 'createSection'])->name('shop.create.section');
Route::post('/shop/store-section', [App\Http\Controllers\ShopController::class, 'storeSection'])->name('shop.store.section');
Route::get('/shop/edit-section/{id}', [App\Http\Controllers\ShopController::class, 'editSection'])->name('shop.edit.section');
Route::post('/shop/update-section/{id}', [App\Http\Controllers\ShopController::class, 'updateSection'])->name('shop.update.section');
Route::get('/shop/delete-section/{id}', [App\Http\Controllers\ShopController::class, 'deleteSection'])->name('shop.delete.section');
Route::post('/shop/change-file', [App\Http\Controllers\ShopController::class, 'updateImg']);
Route::post('/shop/delete-file', [App\Http\Controllers\ShopController::class, 'deleteImg']);
Route::get('/shop/block/{id}/{action}', [App\Http\Controllers\ShopController::class, 'block'])->name('shop.block');
Route::get('shop/detail/{id}', [App\Http\Controllers\ShopController::class, 'detail'])->name('shop.detail');
Route::resource('shop', App\Http\Controllers\ShopController::class);

Route::post('add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'add']);
Route::post('get-total-cart', [App\Http\Controllers\CartController::class, 'getTotal']);
Route::post('get-cart-count', [App\Http\Controllers\CartController::class, 'getCartCount']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::post('delete-from-cart/{id}', [App\Http\Controllers\CartController::class, 'delete']);

Route::view('cart', 'cart')->name('cart.index');
Route::view('search', 'search')->name('search');


//Library
Route::get('/library/create/section', [App\Http\Controllers\LibraryController::class, 'createSection'])->name('library.create.section');
Route::post('/library/store-section', [App\Http\Controllers\LibraryController::class, 'storeSection'])->name('library.store.section');
Route::get('/library/edit-section/{id}', [App\Http\Controllers\LibraryController::class, 'editSection'])->name('library.edit.section');
Route::post('/library/update-section/{id}', [App\Http\Controllers\LibraryController::class, 'updateSection'])->name('library.update.section');
Route::get('/library/delete-section/{id}', [App\Http\Controllers\LibraryController::class, 'deleteSection'])->name('library.delete.section');
Route::post('/library/change-file', [App\Http\Controllers\LibraryController::class, 'updateImg']);
Route::post('/library/delete-file', [App\Http\Controllers\LibraryController::class, 'deleteImg']);
Route::get('/library/block/{id}/{action}', [App\Http\Controllers\LibraryController::class, 'block'])->name('library.block');
Route::get('library/detail/{id}', [App\Http\Controllers\LibraryController::class, 'detail'])->name('library.detail');
Route::resource('library', App\Http\Controllers\LibraryController::class);

Route::post('/comment/send', [App\Http\Controllers\CommentController::class, 'sendComment'])->name('comment.send');
Route::post('/comment/action', [App\Http\Controllers\CommentController::class, 'actionComment'])->name('comment.action');

Auth::routes();
