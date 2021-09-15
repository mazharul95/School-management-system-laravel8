<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    /* ORM Eloquent data read */
    $users = User::all();
    return view('dashboard',compact('users'));
})->name('dashboard');

















