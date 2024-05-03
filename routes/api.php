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
Route::get('/products/published', [ProductController::class, 'publishedProducts']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Rutas Protegidas
Route::middleware(['auth:sanctum'])->group(function() {
  Route::get('/products', [ProductController::class, 'index']);
  Route::post('/products', [ProductController::class, 'store']);
  Route::put('/products/{product}', [ProductController::class, 'update']);
  Route::delete('/products/{product}', [ProductController::class, 'destroy']);
  Route::put('/products/restore/{product}', [ProductController::class, 'restore']);
});
/*  Productos */

/* Usuarios */

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
/* Categorias */
Route::get('/category', [CategoryController::class, 'index'] );
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', function($id) {return 'Category Updated ' . $id;});
Route::delete('/category/{id}', function($id) {return 'Category Deleted ' . $id;});