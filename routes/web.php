<?php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\MultiPicController;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    return view('home',compact('brands'));
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

// admin all route
Route::get('/home/slider', [HomeController::class,'homeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class,'addSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class,'storeSlider'])->name('store.slider');
Route::post('/edit/slider', [HomeController::class,'editSlider'])->name('edit.slider');


//home about all route
Route::get('/home/about', [AboutController::class,'homeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class,'addAbout'])->name('add.about');

//BlogCategory

Route::resource('blog-category',BlogCategoryController::class);









Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    /* ORM Eloquent data read */
    //$users = User::all();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout',[MultiPicController::class,'logout'])->name('user.logout');

















