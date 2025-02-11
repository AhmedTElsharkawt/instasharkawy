<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{posts}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/posts/{posts}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{posts}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/user/update', [HomeController::class, 'update'])->name('user.update');
    Route::put('/user/update-password', [HomeController::class, 'updatePassword'])->name('user.update.password');
    Route::post('/post/{postId}/like', [LikeController::class, 'toggleLike'])->name('post.like');
});






