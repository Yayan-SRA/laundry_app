<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'CST' . mt_rand(10000, 99999),
            'store_id' => 1,
            'name' => fake()->unique()->name(),
            'address' => fake()->streetAddress(),
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
