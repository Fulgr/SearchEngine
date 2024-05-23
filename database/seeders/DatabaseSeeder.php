<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Type::factory()->create([
            'name' => 'Offline',
        ]);
        Type::factory()->create([
            'name' => 'Online',
        ]);
    }
}
