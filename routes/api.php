<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;

// Rotas de autenticação (públicas)
Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register'); // Registro de usuário
    Route::post('/login', 'login');       // Login do usuário
});

// Rotas públicas (sem autenticação)
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index'); // Listar livros
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index'); // Listar categorias
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index'); // Listar autores
});

// Rotas protegidas (JWT middleware)
Route::middleware(JwtMiddleware::class)->group(function () {

    // CRUD de livros (exceto listagem)
    Route::controller(BookController::class)->group(function () {
        Route::post('/books', 'store');   // Criar livro
        Route::get('/books/{id}', 'show'); // Exibir livro
        Route::patch('/books/{id}', 'update'); // Atualizar livro
        Route::delete('/books/{id}', 'destroy'); // Deletar livro
    });
    
    // CRUD de categorias (exceto listagem)
    Route::controller(CategoryController::class)->group(function () {
        Route::post('/categories', 'store'); // Criar categoria
        Route::get('/categories/{id}', 'show'); // Exibir categoria
        Route::patch('/categories/{id}', 'update'); // Atualizar categoria
        Route::delete('/categories/{id}', 'destroy'); // Deletar categoria
    });

    // CRUD de autores (sem atualização, apenas criação e exclusão)
    Route::controller(AuthorController::class)->group(function () {
        Route::post('/authors', 'store');   // Criar autor
        Route::get('/authors/{id}', 'show'); // Exibir autor
        Route::delete('/authors/{id}', 'destroy'); // Deletar autor
    });
    
    // CRUD de ordens
    Route::controller(OrderController::class)->group(function () {
        Route::post('/orders', 'store');    // Criar ordem
        Route::get('/orders/{id}', 'show'); // Exibir ordem
        Route::get('/orders', 'index');    // Listar ordens
        Route::patch('/orders/{id}', 'update'); // Atualizar ordem
        Route::delete('/orders/{id}', 'destroy'); // Deletar ordem
    });
});
