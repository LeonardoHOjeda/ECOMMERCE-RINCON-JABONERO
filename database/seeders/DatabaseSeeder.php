<?php

namespace Database\Seeders;

use App\Models\Order;
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

      if (!SeederModel::where('name', RoleSeeder::class)->exists()) {
        $this->call(RoleSeeder::class);
        SeederModel::create(['name' => RoleSeeder::class]);
      }

      if (!SeederModel::where('name', UserSeeder::class)->exists()) {
        $this->call(UserSeeder::class);
        SeederModel::create(['name' => UserSeeder::class]);
      }

      if (!SeederModel::where('name', CategorySeeder::class)->exists()) {
        $this->call(CategorySeeder::class);
        SeederModel::create(['name' => CategorySeeder::class]);
      }

      if (!SeederModel::where('name', StatusSeeder::class)->exists()) {
        $this->call(StatusSeeder::class);
        SeederModel::create(['name' => StatusSeeder::class]);
      }

      if (!SeederModel::where('name', StatusOrderSeeder::class) ->exists()) {
        $this->call(StatusOrderSeeder::class);
        SeederModel::create(['name' => StatusOrderSeeder::class]);
      }

      if (App::environment('local')) {

        if (!SeederModel::where('name', Product::class)->exists()) {
          Product::factory(30)->create();
          SeederModel::create(['name' => Product::class]);
        }

        if (!SeederModel::where('name', Order::class)->exists()) {
          Order::factory(100)->create();
          SeederModel::create(['name' => Order::class]);
        }
      }
    }
}
