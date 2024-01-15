<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::factory(4)->create();

        \App\Models\Category::factory()->create([
            'name' => 'MacBook',
            'description' => 'MacBook is power full',
            'image' => 'macbok.jpg',
        ]);
    }
}
