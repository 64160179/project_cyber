<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowImageController;
use App\Http\Controllers\PostsController;
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
    return view('welcome');
});


Route::get('/editprofile', function () {
    return view('editprofile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home',[App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('isAdmin');
Route::get('/editprofile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editprofile');

Route::controller(App\Http\Controllers\CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('categories/create', 'create');
    Route::post('categories/create', 'store');
    Route::get('categories/{id}/edit', 'edit');
    Route::put('categories/{id}/edit', 'update');
    Route::get('categories/{id}/delete', 'destroy');
});

Route::controller(App\Http\Controllers\PostsController::class)->group(function () {
    Route::get('posts', 'index');
    Route::get('posts/create', 'create');
    Route::post('posts/create', 'store');
    Route::get('posts/{id}/edit', 'edit');
    Route::put('posts/{id}/edit', 'update');
    Route::get('posts/{id}/delete', 'destroy');
});

