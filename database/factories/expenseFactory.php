<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class expenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'note' => fake()->name(),
            'amount' => fake()->randomDigit(),
            'categoryExpenseId' => fake()->randomDigit(),
            'dateTime' => now(),
            'updated_at' => now(),
            'created_at' => now(),
            'deleted_at' => null,
        ];
    }
}
