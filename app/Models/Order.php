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
}
