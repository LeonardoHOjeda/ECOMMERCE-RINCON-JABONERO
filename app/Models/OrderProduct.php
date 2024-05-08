<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];

    public $timestamps = false;

    protected static function booted ()
    {
        static::creating(function ($orderProduct) {
            $product = Product::find($orderProduct->product_id);
            $orderProduct->subtotal = $product->price * $orderProduct->quantity;
        });
    }
}
