<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $adjectives = ['Modern', 'Elegant', 'Stylish', 'Classic', 'Premium', 'Eco'];
        $items = ['Chair', 'Lamp', 'Watch', 'Laptop', 'Headset', 'Table'];

        return [
            'product_name' => $this->faker->randomElement($adjectives) . ' ' .
                              $this->faker->randomElement($items),
            'description' => $this->faker->paragraph(),
            'mrp_price' => $this->faker->randomFloat(2, 500, 5000),
            'selling_price' => $this->faker->randomFloat(2, 400, 4500),
            'status' => $this->faker->randomElement(['A', 'D', 'E']),
        ];
    }
}
