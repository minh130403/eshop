<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $srcs = [
            ''
        ];

        return [
            'name' => fake()->name(),
            'alt' => fake()->sentence(),
            'src' => 'images/product'
        ];
    }


    protected static function newFactory() {
        return MediaFactory::new();
    }



    /**
     * The name of the factory's corresponding model
     * 
     * @var string
     */

     protected $model = Media::class;
}
