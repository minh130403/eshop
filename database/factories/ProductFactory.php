<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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
    public function definition()
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'short_description' => fake()->paragraph(3),
            'description' => fake()->paragraph(20),
            'slug' => Str::of($name)->slug('_'),
            'price' => fake()->numberBetween(1, 10000000)
        ];
    }


    public function configure(){
        return $this->afterCreating(function (Product $product) {
            $categories = Category::all()->pluck('id')->toArray();
            $product->categories()->attach(fake()->randomElements($categories));
            $product->avatar()->associate(Media::first());
            $product->save();
        });
    }
}
