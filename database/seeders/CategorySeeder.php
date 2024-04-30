<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Artesanal',
            'description' => 'Productos hechos a mano'
        ]);

        Category::create([
            'name' => 'Industrial',
            'description' => 'Productos fabricados en serie'
        ]);

        Category::create([
            'name' => 'Orgánico',
            'description' => 'Productos naturales'
        ]);

        Category::create([
            'name' => 'Reciclado',
            'description' => 'Productos hechos con material reciclado'
        ]);

        Category::create([
            'name' => 'Sostenible',
            'description' => 'Productos que respetan el medio ambiente'
        ]);
    }
}
