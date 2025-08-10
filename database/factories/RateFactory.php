<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'base_currency_id'   => 'USD',
            'target_currency_id' => $this->faker->currencyCode(),
            'rate'   => $this->faker->randomFloat(6, 0.5, 200),
            'effective_date'   => now()->format('Y-m-d'),
        ];
    }
}
