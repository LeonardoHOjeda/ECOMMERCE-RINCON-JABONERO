<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Borrador'
        ]);

        Status::create([
            'name' => 'Publicado'
        ]);

        Status::create([
            'name' => 'Archivado'
        ]);

        Status::create([
            'name' => 'Eliminado'
        ]);
    }
}
