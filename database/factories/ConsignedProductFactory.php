<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsignedProduct>
 */
class ConsignedProductFactory extends Factory
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
            'userid' => User::factory(),
            'date_received' => $this->faker->date(),
        ];
    }
}
