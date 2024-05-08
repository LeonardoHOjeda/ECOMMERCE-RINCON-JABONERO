<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * TODO: Implement pagination
     */
    public function index()
    {
        $orders = Order::with('user:id,name,lastname,email,cellphone', 'status_order')->get();

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $body = $request->validate([
        'tracking_number' => 'required',
        'products' => 'required|array',
        'products.*.product_id' => 'required|integer',
        'products.*.quantity' => 'required|numeric'
      ]);
      
      // Obtener el último número de orden

      $order = Auth::user()->orders()->create($body);
      $order->products()->createMany($body['products']);
      $orderTotal = $order->products()->sum('subtotal');
      $order->update(['order_total' => $orderTotal]);

      return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);

        $order = Order::with('user:id,name,lastname,email,cellphone', 'status_order')->findOrFail($order->id);

        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
      Gate::authorize('update', $order);

      $body = $request->validate([
        'order_total' => 'numeric',
        'tracking_number' => 'string',
        'status_order_id' => 'integer'
      ]);

      $order->update($body);

      return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
