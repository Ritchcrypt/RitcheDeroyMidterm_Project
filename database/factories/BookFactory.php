<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'isbn' => $this->faker->isbn13(),
            'published_at' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::inRandomOrder()->first()?->id,
        ];
    }
}
