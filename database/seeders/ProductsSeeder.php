<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Elit repadjsdad',
            'price' => 19,
            'quantity' => 20,
            'inStock' => 19,
            'category_id' => random_int(1, 3),
            'brand_id' => random_int(1, 3),
            'description' => 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book'
        ]);
    }
}
