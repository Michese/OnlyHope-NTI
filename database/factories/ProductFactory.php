<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Product ' . $this->faker->unique()->randomNumber(),
            'description' => $this->faker->text(50),
            'src' => $this->faker->unique()->randomElement([
                '/img/equipment1.jpg',
                '/img/equipment2.jpg',
                '/img/equipment3.jpg',
                '/img/equipment4.jpg',
                '/img/equipment5.jpg'
            ]),
            'price' => rand(15000, 100000)
        ];
    }
}
