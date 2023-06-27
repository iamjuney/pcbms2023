<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prod_name' => $this->faker->word,
            'shelf_life' => $this->faker->numberBetween(1, 50),
            'unit' => $this->faker->randomElement(Product::getAvailableUnits()),
            'appreciation' => $this->faker->randomFloat(2, 0, 99.99),
            'max_lvl' => 50,
        ];
    }
}
