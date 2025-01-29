<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph(5),
            'slug' => Str::slug($this->faker->sentence),
            'image' => $this->faker->imageUrl(800, 600, 'nature'), // Adjust the size or source as needed
            'is_published' => $this->faker->boolean(80), // 80% chance of being true
        ];
    }
}
