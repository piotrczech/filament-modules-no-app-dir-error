<?php

namespace Modules\MyModule\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\MyModule\Models\Category;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\MyModule\Models\Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(6);
        return [
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title) . '-' . Str::random(6),
            'excerpt' => $this->faker->optional()->paragraph(),
            'content' => $this->faker->paragraphs(4, true),
            'is_published' => $this->faker->boolean(70),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

