<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiPicController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Brand;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::resource('contact',ContactController::class);
Route::get('asd',[ContactController::class,'index'])->name('piyash');
Route::get('/category/all',[CategoryController::class,'allCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'addCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'editCategory'])->name('category.edit');
Route::put('/category/update/{id}',[CategoryController::class,'updateCategory'])->name('category.update');
Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'restoreData']);
Route::get('/delete/category/{id}',[CategoryController::class,'delete']);


///for Brand Route
Route::get('/brand/all', [BrandController::class,'allBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'editBrand'])->name('brand.edit');
Route::put('/brand/update/{id}',[BrandController::class,'updateBrand'])->name('brand.update');
Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');

///for MultiPic Route
Route::get('/multi/image',[MultiPicController::class,'multipic'])->name('multi.image');
Route::post('/multi/add',[MultiPicController::class,'storeImg'])->name('store.image');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    /* ORM Eloquent data read */
    //$users = User::all();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout',[MultiPicController::class,'logout'])->name('user.logout');

















