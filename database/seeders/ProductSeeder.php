<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(30)->create()->each(function ($product) {
            ProductImage::factory(rand(3, 5))->create([
                'product_id' => $product->id
            ]);
        });
    }
}
