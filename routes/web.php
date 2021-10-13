<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Payment;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category/getCategory',[CategoryController::class,'getCategory'])->name('Category.getCategory');

Route::get('/category/ajaxview',[CategoryController::class,'ajaxview'])->name('Category.ajaxview');

Route::resource('category', CategoryController::class)->middleware('auth');
Route::resource('posts', PostController::class);
Route::resource('posts.comment', CommentController::class);
Route::resource('product', ProductController::class)->middleware('auth');

Route::get('/location',[LocationController::class,'index'])->name('location');
Route::post('/location/create',[LocationController::class,'create'])->name('location.create');
Route::post('/location/storeCountry',[LocationController::class,'storeCountry'])->name('location.store.country');
Route::post('/location/storeRegion',[LocationController::class,'storeRegion'])->name('location.store.region');
Route::post('/location/storeCity',[LocationController::class,'storeCity'])->name('location.store.city');
Route::post('/location/getRegion',[LocationController::class,'getRegion'])->name('location.getRegion');
Route::get('/payment/submit',[Payment::class,'submit'])->name('payment.submit');
Route::get('/payment/redirect',[Payment::class,'redirect'])->name('payment.redirect');

Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');
