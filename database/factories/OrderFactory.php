<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supp_id' => Supplier::factory(),
            'userid' => 1,
            'order_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pending', 'Received', 'Cancelled']),
        ];
    }
}
