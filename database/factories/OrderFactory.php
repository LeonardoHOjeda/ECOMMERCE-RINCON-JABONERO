<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\StatusOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {
      $statusOrderId = StatusOrder::inRandomOrder()->first()->id;
      $userId = User::inRandomOrder()->first()->id;

      // Generar el número de orden con el formato deseado
      $orderNumber = 'RJ' . str_pad($this->faker->unique()->numberBetween(1, 1000), 5, '0', STR_PAD_LEFT);
      
        return [
            'order_date' => $this->faker->dateTimeThisYear(),
            'order_total' => $this->faker->randomFloat(2, 1, 1000),
            'order_number' => $orderNumber,
            'tracking_number' => $this->faker->unique()->numberBetween(1, 1000),
            'user_id' => $userId,
            'status_order_id' => $statusOrderId,
        ];
    }
}
