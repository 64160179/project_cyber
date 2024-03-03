<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
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

Route::controller(App\Http\Controllers\PostsController::class)->group(function () {
    Route::get('posts', 'index');
    Route::get('posts/create', 'create');
    Route::post('posts/create', 'store');
    Route::get('posts/{id}/edit', 'edit');
    Route::put('posts/{id}/edit', 'update');
    Route::get('posts/{id}/delete', 'destroy');
    Route::get('search', 'search');
});


