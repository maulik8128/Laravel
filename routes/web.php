<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;

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

Route::resource('category', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('posts.comment', CommentController::class);
Route::resource('product', ProductController::class)->middleware('auth');

