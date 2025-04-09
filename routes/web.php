<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseController;



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class,'index'])->name('home')->middleware('auth');

Route::get('/create', [HouseController::class,'create'])->name('create-house');

Route::get('/update/{id}', [HouseController::class,'update'])->name('update-house');

Route::get('/delete/{id}', [HouseController::class,'destroy'])->name('destroy-house');

Route::get('/houses/{id}/edit', [HouseController::class, 'edit'])->name('houses.edit');

Route::get('/houses/{id}/show', [HouseController::class, 'show'])->name('houses.show');

Route::get('/houses/{house}/photos/{photo}', [HouseController::class,'destroyImage'])->name('destroy-image');

// Route::get('/store', [HouseController::class, 'create'])->name('create-house');

Route::get('/posts', [HomeController::class, 'index'])->name('posts.index');

Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');

Route::post('/store', [HouseController::class,'store'])->name('store-house');

Route::get('/edit', [HomeController::class, 'edit'])->name('edit');

Route::get('/delete', [HomeController::class, 'delete'])->name('delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


//Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
/*
Route::get('/', function () {
    return view('index');
})->middleware('auth');
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

