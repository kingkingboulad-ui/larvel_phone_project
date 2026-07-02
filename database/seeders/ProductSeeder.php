<?php

namespace Database\Seeders;

use App\Models\ProductsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            ProductsModel::create([
                'title' => 'Product ' . $i,
                'description' => 'Description for product ' . $i,
                'price' => rand(10, 500),
                'image' => null,
                'is_featured' => rand(0, 1),
                'category_id' => 1,
                'brand_id' => 1,
            ]);
        }
    }
}
