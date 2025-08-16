<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'image' => 'https://picsum.photos/600/400?random=' . $this->faker->unique()->numberBetween(1, 1000),
            'status' => $this->faker->randomElement(['A', 'D', 'E']),
        ];
    }
}
