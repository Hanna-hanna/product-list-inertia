<?php

namespace Database\Seeders;

use App\Domains\Products\Models\Eloquent\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Smartwatch XYZ',
                'description' => 'High-quality smartwatch with fitness tracking capabilities.',
                'price' => 199.99,
                'stock' => 50,
                'rank' => 1,
                'image' => 'image1.jpg',
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Noise-cancelling wireless headphones with long battery life.',
                'price' => 149.99,
                'stock' => 35,
                'rank' => 2,
                'image' => 'image2.jpg',
            ],
            [
                'name' => 'USB-C Power Bank',
                'description' => '20000mAh power bank with fast charging capabilities.',
                'price' => 69.99,
                'stock' => 100,
                'rank' => 3,
                'image' => 'image3.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
