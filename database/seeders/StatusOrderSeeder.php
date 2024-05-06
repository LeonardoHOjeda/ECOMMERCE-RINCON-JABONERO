<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusOrder::create([
          'name' => 'Pedido recibido',
          'description' => 'El pedido ha sido recibido por el sistema'
        ]);

        StatusOrder::create([
          'name' => 'Pago pendiente',
          'description' => 'El pago del pedido está pendiente'
        ]);

        StatusOrder::create([
          'name' => 'Pago recibido',
          'description' => 'Se ha recibido el pago de la orden de compra'
        ]);

        StatusOrder::create([
          'name' => 'Preparando el envío',
          'description' => 'El pedido se encuentra en preparación'
        ]);

        StatusOrder::create([
          'name' => 'Enviado',
          'description' => 'El pedido ha sido entregado al transportista para su envío'
        ]);

        StatusOrder::create([
          'name' => 'Retrasado',
          'description' => 'El pedido experimenta un retraso en su entre'
        ]);

        StatusOrder::create([
          'name' => 'Entregado',
          'description' => 'El pedido ha sido entregado.'
        ]);

        StatusOrder::create([
          'name' => 'Cancelado',
          'description' => 'El pedido ha sido cancelado.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolsado',
          'description' => 'El pedido ha sido reembolsado.'
        ]);

        StatusOrder::create([
          'name' => 'Error',
          'description' => 'El pedido ha experimentado un error. Te contactaremos para solucionarlo.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolso pendiente',
          'description' => 'El pedido ha sido reembolsado, pero aún no se ha completado el proceso.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolso completado',
          'description' => 'El pedido ha sido reembolsado completamente.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolso parcial',
          'description' => 'El pedido ha sido reembolsado parcialmente.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolso rechazado',
          'description' => 'El pedido ha sido reembolsado, pero ha sido rechazado.'
        ]);

        StatusOrder::create([
          'name' => 'Reembolso fallido',
          'description' => 'El pedido ha sido reembolsado, pero ha fallado.'
        ]);
    }
}
