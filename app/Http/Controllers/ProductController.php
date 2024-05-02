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

    public function update (Request $request, Product $product)
    {
      $body = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'status_id' => 'required|numeric',
        'category_id' => 'required|numeric'
      ]);

      $product->update($body);

      return [
        "error" => null,
        "data" => $product,
      ];
    }

    public function destroy (Product $product)
    {
        $product->delete();
  
        return [
          "error" => null,
          "data" => $product,
        ];
    }

    public function restore (Request $request, $id)
    {
      $product = Product::withTrashed()->findOrFail($id);

      // Restaurar el producto eliminado
      $product->restore();

      return $product;
    }
}
