<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'full_address' => fake()->address,
            'phone' =>
            fake()->phoneNumber(),
            'prov_id' => fake()->numberBetween(1, 34),
            'city_id' => fake()->numberBetween(1, 100),
            'district_id' => fake()->numberBetween(1, 100),
            'village' => fake()->city,
            'postal_code' => fake()->postcode,
            'user_id' => fake()->numberBetween(1, 11),
            'is_default' => fake()->boolean,
        ];
    }
}
