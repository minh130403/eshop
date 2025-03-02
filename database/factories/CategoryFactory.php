<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'description' => fake()->paragraph(3),
            'slug' => Str::of($name)->slug('_')
        ];
    }


    public function configure(){
        return $this->afterCreating(function (Category $category){
            $category->avatar()->associate(Media::factory()->create());
            $category->save();
        });
    }
}
