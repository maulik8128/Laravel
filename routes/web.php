<?php

use App\Http\Controllers\ActivityLogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExceldataController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Payment;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

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
// Route::get('/posts/{id}',function($id){
//     return 'post'.$id;
// })->where(['id'=>'[0-9]+'])->name('home.posts');
// $posts=[
//         1 =>[
//             'title'=>'test1',
//             'contact' => 'contact1',
//             'is_new' => true,
//             'has_comments' => true
//         ],
//         2 =>[
//             'title'=>'test2',
//             'contact' => 'contact2',
//             'is_new' => false
//         ],

// ];

// Route::get('/posts',function() use($posts) {
//     return view('posts.index',['posts'=> $posts]);
// });

// Route::get('/post-show/{id}',function($id) use($posts) {

//     abort_if(!isset($posts[$id]),404);

//     return view('posts.show',['posts'=>$posts[$id]]);

// })->name('post.show');

// Route::get('/fun/response', function() use($posts){
//     return response($posts, 201)
//     ->header('Content-Type', 'application/json')
//     ->cookie('MY_COOKIE','MAULIK',3600);
// });

// Route::get('/fun/redirect', function(){
//     return redirect('/contact');
// });

// Route::get('/fun/back', function(){
//     return back();
// });

// Route::get('/fun/name-route', function(){
//     return redirect()->route('post.show',['id' => 1]);
// });

// Route::get('/fun/away', function(){
//     return redirect()->away('http://google.co.in');
// });

// Route::get('/fun/json', function() use($posts){
//     return response()->json($posts);
// });

// Route::prefix('/fun')->name('fun.')->group(function(){
//     // remove /fun prefix below route
//     Route::get('/download', function(){
//         return response()->download(public_path('/path'),'face.jpg');
//     })->name('download');
// });

// Route::get('/query',function() use($posts) {
//     // dd(request()->all());
//     // dd((int)request()->input('page',10));
//     dd((int)request()->query('page',10));

// });
// Route::get('/single', AboutController::class);

Route::get('/', function () {
    return redirect()->route('login');
});
Route::post('/user/registration', [App\Http\Controllers\auth\RegisterController::class,'register'])->name('register.create');
Route::post('/user/checkEmailExist', [App\Http\Controllers\auth\RegisterController::class,'checkEmailExist'])->name('register.checkEmailExist');
Route::post('/user/checkUsernameExist', [App\Http\Controllers\auth\RegisterController::class,'checkUsernameExist'])->name('register.checkUsernameExist');
Auth::routes(['verify' => true]);
// Auth::routes(['register' => false]);

// Auth::routes([
//     'register' => false, // Registration Routes...
//     'reset' => false, // Password Reset Routes...
//     'verify' => false, // Email Verification Routes...
//   ]);

Route::get('/google', [GoogleController::class,'redirectToGoogle'])->name('google');
Route::get('/google/callback', [GoogleController::class,'handleGoogleCallback']);


Route::middleware(['auth','verified','userStatus'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->withoutMiddleware(['userStatus'])->name('home');
    Route::post('/markNotification', [App\Http\Controllers\HomeController::class, 'markNotification'])->name('home.markNotification');

    Route::get('/category/getCategory',[CategoryController::class,'getCategory'])->name('Category.getCategory');
    Route::get('/category/ajaxview',[CategoryController::class,'ajaxview'])->name('Category.ajaxview');
    Route::resource('category', CategoryController::class);

    Route::resource('posts', PostController::class);
    Route::resource('posts.comment', CommentController::class);

    Route::get('refreshCaptcha',[ProductController::class,'refreshCaptcha'])->name('product.refreshCaptcha');
    Route::resource('product', ProductController::class);

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

    Route::get('mailable', function(){
        $comment = App\Models\Comment::find(1);
        return new App\Mail\CommentPosted($comment);
    });
    Route::post('user/ajaxDisableAll',[UserController::class,'ajaxDisableAll'])->name('user.ajaxDisableAll');
    Route::resource('user', UserController::class);

    Route::resource('questions', QuestionsController::class);

    Route::get('/clear', function(){
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return redirect('/');
    });

    Route::get('/exceldata/createData',[ExceldataController::class,'createData'])->name('Exceldata.createData');
    Route::view('/exceldata/create','exceldata.add_exceldata');

    Route::resource('permissions',PermissionsController::class);
    Route::resource('roles',RolesController::class);

    Route::resource('activityLogs',ActivityLogsController::class);



});


