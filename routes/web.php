<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::resource('users', App\Http\Controllers\UserController::class)->except(['index', 'create', 'store']);
Route::resource('posts', App\Http\Controllers\PostController::class);

//tags show
Route::get('tags/{tag}', [App\Http\Controllers\TagController::class, 'show'])->name('tags.show');

