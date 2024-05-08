<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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

/* Productos */
Route::get('/products/published', [ProductController::class, 'publishedProducts']);
Route::get('/products/{id}', [ProductController::class, 'show']);

/* Categorias */
Route::get('/category', [CategoryController::class, 'index'] );


// Rutas Protegidas
Route::middleware(['auth:sanctum'])->group(function() {
  /*
  |--------------------------------------------------------------------------
  | PRODUCTOS
  |--------------------------------------------------------------------------
  */
  Route::get('/products', [ProductController::class, 'index']);
  Route::post('/products', [ProductController::class, 'store']);
  Route::put('/products/{product}', [ProductController::class, 'update']);
  Route::delete('/products/{product}', [ProductController::class, 'destroy']);
  Route::put('/products/restore/{product}', [ProductController::class, 'restore']);

  /*
  |--------------------------------------------------------------------------
  | USUARIOS
  |--------------------------------------------------------------------------
  */
  Route::get('/users', [UserController::class, 'index']);
  Route::put('/user/{user}', [UserController::class, 'update']);

  /*
  |--------------------------------------------------------------------------
  | CATEGORIAS
  |--------------------------------------------------------------------------
  */
  // TODO: Cambiar a Model Binding
  Route::post('/category', [CategoryController::class, 'store']);
  Route::put('/category/{category}', [CategoryController::class, 'update']);
  Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
  
  /*
  |--------------------------------------------------------------------------
  | ORDENES
  |--------------------------------------------------------------------------
  */
  Route::get('/orders', [OrderController::class, 'index']);
  Route::post('/orders', [OrderController::class, 'store']);
  Route::get('/orders/{order}', [OrderController::class, 'show']);
  Route::put('/orders/{order}', [OrderController::class, 'update']);
});