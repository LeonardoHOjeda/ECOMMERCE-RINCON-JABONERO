<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'order_total',
        'order_number',
        'tracking_number',
        'user_id',
        'status_order_id'
    ];

    public function status_order()
    {
        return $this->belongsTo(StatusOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products ()
    {
        return $this->hasMany(OrderProduct::class);
    }

    protected static function booted ()
    {
        static::creating(function ($order) {
          $lastOrderNumber = Order::max('order_number');
          $orderNumber = $lastOrderNumber ? substr($lastOrderNumber, 2) : null;
          $nextOrderNumber = $orderNumber ? $orderNumber + 1 : 1;
          $order->order_number = 'RJ' . str_pad($nextOrderNumber, 5, '0', STR_PAD_LEFT);
          $order->status_order_id = StatusOrder::PEDIDO_RECIBIDO;
        });
    }
}
