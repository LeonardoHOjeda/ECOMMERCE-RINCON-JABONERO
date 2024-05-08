<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    use HasFactory;

    protected $table = 'status_orders';

    public $timestamps = false;

    protected $fillable = [
      'name',
      'description'
    ];

    const PEDIDO_RECIBIDO = 1;
    const PAGO_PENDIENTE = 2;
    const PAGO_RECIBIDO = 3;
    const PREPARANDO_ENVIO = 4;
}
