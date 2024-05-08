<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);

        return $category;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $body = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category = Category::create($body);

        return $category;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
      $body = $request->validate([
        'name' => 'string',
        'description' => 'string'
      ]);

      $category->update($body);

      return $category;
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
      $category->delete();

      return $category;
    }
}
