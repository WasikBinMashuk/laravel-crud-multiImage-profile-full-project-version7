<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MultiImgController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('About/us',[ContentController::class,'AboutPage'])->name('about.page');

//Auth::routes();
Auth::routes(['verify' => true]);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Category
Route::get('Category/All',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('Category/Add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('Category/Edit/{id}',[CategoryController::class,'Edit']);
Route::post('Store/Category/{id}',[CategoryController::class,'update']);
Route::get('softdelete/category/{id}',[CategoryController::class,'SoftDelete']);
Route::get('Category/restore/{id}',[CategoryController::class,'Restore']);
Route::get('Category/p-delete/{id}',[CategoryController::class,'Pdelete']);


//Brand
Route::get('Brand/All',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('Brand/Add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('Brand/Edit/{id}',[BrandController::class,'Edit']);
Route::post('Update/Brand/{id}',[BrandController::class,'update']);
Route::get('Delete/Brand/{id}',[BrandController::class,'Delete']);


//Multi Image
Route::get('multi/image',[MultiImgController::class,'index'])->name('multi.image');
Route::post('multi/image/store',[MultiImgController::class,'StoreImg'])->name('store.image');
Route::get('multi/image/Delete/{id}',[MultiImgController::class,'Delete']);

//PROFILE
Route::get('User/profile',[ProfileController::class,'profile'])->name('profile.user');
Route::post('User/update/profile',[ProfileController::class,'update'])->name('update.user');

//Password
Route::get('User/password',[ProfileController::class,'password'])->name('change.password');
Route::post('User/update/password',[ProfileController::class,'UpdatePassword'])->name('update.password');
