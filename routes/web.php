<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $posts = App\Models\Posts::all(); // หรือเลือกตามเงื่อนไขที่ต้องการ
    return view('welcome', compact('posts'));
});

Route::get('/editprofile', function () {
    return view('editprofile');
});

Route::get('/admin/posts', function () {
    $posts = App\Models\Posts::all();
    return view('admin.posts', compact('posts'));
});

Route::get('/admin/users', function () {
    $users = \App\Models\User::all();
    return view('admin.users', compact('users'));
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home',[App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('isAdmin');

Route::get('/editprofile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editprofile');

Route::post('/update-name', [App\Http\Controllers\UserController::class, 'updateName'])->name('update-name');
Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');

Route::post('posts/{posts}/comment', [App\Http\Controllers\PostsController::class, 'comment'])->name('post.comment');
Route::post('comments/{post}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment');
Route::get('comment/{comment}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
Route::delete('comment/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');



Route::controller(App\Http\Controllers\PostsController::class)->group(function () {
    Route::get('posts', 'index');
    Route::get('posts/create', 'create');
    Route::post('posts/create', 'store');
    Route::get('posts/{id}/edit', 'edit');
    Route::put('posts/{id}/edit', 'update');
    Route::get('posts/{id}/delete', 'destroy');
    Route::get('search', 'search');
});

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('user', 'index');
    Route::get('user/{id}/edit', 'edit');
    Route::put('user/{id}/edit', 'update');
    Route::get('user/{id}/delete', 'destroy');
    Route::get('searchuser', 'search');
});

