<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index ()
    {
      $products = Product::with('category', 'status')->get();

      if ($products->isEmpty()) {
        return response()->json(['message' => 'No products found'], 200);
      }

      return response()->json($products, 200);
    }

    // Obtener todos los productos publicados y no eliminados 
    public function publishedProducts ()
    {
      $products = Product::with('category', 'status')
        ->where('status_id', 2)
        ->whereNull('deleted_at')
        ->get();

      if ($products->isEmpty()) {
        return response()->json(['message' => 'No products found'], 200);
      }

      return response()->json($products, 200);
    }

    public function show (Request $request, $id)
    {
      $product = Product::with('category', 'status')->findOrFail($id);

      return $product;
    }

    public function store (Request $request)
    {
      $body = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'status_id' => 'required|numeric',
        'category_id' => 'required|numeric'
      ]);

      try {
        $product = Product::create($body);

        return response()->json($product, 201);
      } catch (\Throwable $th) {
        throw $th;
      }
    }

    public function update (Request $request, $id)
    {
      try {
        $product = Product::findOrFail($id);
  
        $body = $request->validate([
          'name' => 'required',
          'description' => 'required',
          'price' => 'required|numeric',
          'stock' => 'required|numeric',
          'status_id' => 'required|numeric',
          'category_id' => 'required|numeric'
        ]);
  
        $product->update($body);
  
        return $product;
      } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Product not found'], 404);
      }
    }

    public function destroy (Request $request, $id)
    {
      try {
        $product = Product::findOrFail($id);
  
        // Agregar el valor de la fecha de eliminación a la columna deleted_at
        $product->delete();
  
        return $product;
      } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Product not found'], 404);
      }
    }

    public function restore (Request $request, $id)
    {
      try {
        $product = Product::withTrashed()->findOrFail($id);
  
        // Restaurar el producto eliminado
        $product->restore();
  
        return $product;
      } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Product not found'], 404);
      }
    }
}
