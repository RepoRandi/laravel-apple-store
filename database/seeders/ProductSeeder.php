<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory(9)->create();

        \App\Models\Product::factory()->create([
            'name' => 'MacBook Pro M3',
            'description' => 'MacBook M3 Black Cat',
            'image' => 'm3.jpg',
            'price' => 25000000,
            'stock' => 10,
            'weight' => 500,
            'is_available' => true,
            'category_id' => 5,
        ]);
    }
}
