<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\PostCommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/user/register',[UserController::class,'register']);
Route::post('/user/login',[UserController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::post('/user/logout',[UserController::class,'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::get('/user', [UserController::class,'authenticatedUserDetails']);

    Route::apiResource('/posts',PostCommentController::class);

});
