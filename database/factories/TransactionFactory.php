<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> mt_rand(1,3),
            'total_price' => fake()->numberBetween(10000,100000),
            'transaction_time' => fake()->dateTime(),
            'status' => fake()->boolean(),
        ];
    }
}
