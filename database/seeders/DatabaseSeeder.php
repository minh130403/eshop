<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Level::factory()->create([
            'name' => 'admin',
        ]);

        \App\Models\Level::factory()->create([
            'name' => 'user',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'level_id' => 1
        ]);


        \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(100)->create();
    }
}
