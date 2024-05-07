<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

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
        'order_total' => 'required|numeric',
        'tracking_number' => 'required',
        'user_id' => 'required|numeric',
        'status_order_id' => 'required|numeric'
      ]);
      
      Gate::authorize('create', [Order::class, User::findOrFail($body['user_id'])]);
      
      // Obtener el último número de orden
      $lastOrderNumber = Order::max('order_number');
      $orderNumber = $lastOrderNumber ? substr($lastOrderNumber, 2) : null;
      $nextOrderNumber = $orderNumber ? $orderNumber + 1 : 1;

      $body['order_number'] = 'RJ' . str_pad($nextOrderNumber, 5, '0', STR_PAD_LEFT);
      $order = Order::create($body);

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
    public function update(Request $request, string $id)
    {
        $body = $request->validate([
          'order_total' => 'numeric',
          'tracking_number' => 'required',
          'user_id' => 'required|numeric',
          'status_order_id' => 'required|numeric'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
