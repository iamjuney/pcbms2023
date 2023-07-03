<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\ConsignedDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesDetail>
 */
class SalesDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_id' => Sale::factory(),
            'item_id' => ConsignedDetail::factory(),
            'qty_sold' => $this->faker->numberBetween(1, 100),
            'amount_sold' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
