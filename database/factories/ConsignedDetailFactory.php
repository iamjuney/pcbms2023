<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ConsignedProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsignedDetail>
 */
class ConsignedDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cp_id' => ConsignedProduct::factory(),
            'prod_id' => Product::factory(),
            'barcode' => $this->faker->numerify('##########'),
            'particulars' => $this->faker->sentence(5),
            'expiry_date' => $this->faker->date(),
            'unit_price' => $this->faker->randomFloat(2, 1, 100),
            'selling_price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
