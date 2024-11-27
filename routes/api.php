<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;

Route::prefix('auth')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('logout', [UserController::class, 'logout'])->middleware('jwt');
});


Route::get('/books', [BookController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);

// Rotas protegidas (JWT middleware)
Route::middleware('jwt')->group(function () {
    Route::resource('books', BookController::class)->except(['index']);
    Route::resource('categories', CategoryController::class)->except(['index']);
    Route::resource('authors', AuthorController::class)->except(['index', 'edit', 'update']);
    Route::resource('orders', OrderController::class);
});
