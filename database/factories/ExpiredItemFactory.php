<?php

namespace Database\Factories;

use App\Models\Expired;
use App\Models\ConsignedDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpiredItem>
 */
class ExpiredItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exp_id' => Expired::factory(),
            'item_id' => ConsignedDetail::factory(),
            'quantity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
