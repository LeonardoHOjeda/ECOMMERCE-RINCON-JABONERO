<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {

      $statusId = Status::inRandomOrder()->first()->id;
      $categoryId = Category::inRandomOrder()->first()->id;

        return [
            'name' => 'Product ' . $this->faker->unique()->numberBetween(1, 1000),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(),
            'status_id' => $statusId,
            'category_id' => $categoryId,
        ];
    }
}
