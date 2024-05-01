<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
  return [
      'message' => 'It Works!'
  ];
});

require __DIR__.'/auth.php';


// Rutas Publicas

// Rutas Protegidas

/*  Productos */
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/published', [ProductController::class, 'publishedProducts']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);
Route::put('/products/restore/{product}', [ProductController::class, 'restore']);

/* Usuarios */

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
/* Categorias */
Route::get('/category', [CategoryController::class, 'index'] );

Route::get('/category/{id}', function($id) {
  return 'Category Detail ' . $id;
});

Route::post('/category', [CategoryController::class, 'store']);

Route::put('/category/{id}', function($id) {return 'Category Updated ' . $id;});

Route::delete('/category/{id}', function($id) {return 'Category Deleted ' . $id;});