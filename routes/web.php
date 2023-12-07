<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\VisitorBlogController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/single/post',[HomeController::class,'singlePost'])->name('single-post');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
//client reg
Route::get('/signup',[VisitorController::class,'signUp'])->name('sign-up');
Route::post('/signup/store',[VisitorController::class,'store'])->name('sign-up-store');
Route::get('/visitor/signin',[VisitorController::class,'visitorSignIn'])->name('visitor.signin');
Route::post('/visitor/signin',[VisitorController::class,'visitorLogInCheck'])->name('visitor.signin');

Route::get('/category',[HomeController::class,'category'])->name('category');
Route::get('/blog/details/{slug}',[HomeController::class,'blogDetails'])->name('blog.details');
//========================my profile============================================
Route::get('/my/profile',[HomeController::class,'myProfile'])->name('my.profile');
Route::get('/my/signout',[VisitorController::class,'signOut'])->name('sign.out');
Route::get('/create/post',[HomeController::class,'createpost'])->name('create-post');
Route::resources(['visitorblogs'=>VisitorBlogController::class]);
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resources(['categories'=>CategoryController::class]);
    Route::resources(['blogs'=>BlogController::class]);

});
