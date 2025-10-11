<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'coffee', true),
            'best_seller' => $this->faker->boolean(30),
        ];
    }
}
