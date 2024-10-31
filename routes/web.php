<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('index',[CategoryController::class,'index']);
Route::get('/',[CategoryController::class,'index']);

Route::get('login', [CategoryController::class, 'loginpage'])->name('login');

Route::get('register',[CategoryController::class,'registerpage']);

Route::post('register',[CategoryController::class,'register']);
Route::post('login',[CategoryController::class,'login']);
Route::post('logout',[CategoryController::class,'logout'])->name('logout');


Route::get('post',[PostController::class,'post'])->middleware('auth');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::put('/post{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{id}',[PostController::class,'delete']);