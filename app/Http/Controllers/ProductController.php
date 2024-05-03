<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index ()
    {
      Gate::authorize('viewAny', Product::class);

      $products = Product::with('category', 'status')->get();

      return $products;
    }

    public function publishedProducts ()
    {
      $products = Product::with('category', 'status')
        ->where('status_id', 2)
        ->whereNull('deleted_at')
        ->get();

      return $products;
    }

    public function show (Request $request, $id)
    {
      $product = Product::with('category', 'status')->findOrFail($id);

      return $product;
    }

    public function store (Request $request)
    {
      Gate::authorize('create', Product::class);

      $body = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'status_id' => 'required|numeric',
        'category_id' => 'required|numeric'
      ]);

      $product = Product::create($body);

      return $product;
    }

    public function update (Request $request, Product $product)
    {
      Gate::authorize('update', $product);

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
    }

    public function destroy (Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();
  
        return $product;
    }

    public function restore (Request $request, string $id)
    {
      Gate::authorize('restore', Product::class);
      
      $product = Product::withTrashed()->findOrFail($id);

      // Restaurar el producto eliminado
      $product->restore();

      return $product;
    }
}
