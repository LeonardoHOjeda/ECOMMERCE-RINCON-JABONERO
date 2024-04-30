<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seeder as SeederModel;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      if (!SeederModel::where('name', CategorySeeder::class)->exists()) {
        $this->call(CategorySeeder::class);
        SeederModel::create(['name' => CategorySeeder::class]);
      }

      if (!SeederModel::where('name', StatusSeeder::class)->exists()) {
        $this->call(StatusSeeder::class);
        SeederModel::create(['name' => StatusSeeder::class]);
      }

      if (App::environment('local')) {
        // Ejecutar los seeders de desarrollo como factories
        if (!SeederModel::where('name', Product::class)->exists()) {
          Product::factory(30)->create();
          SeederModel::create(['name' => Product::class]);
        }
      }
    }
}
