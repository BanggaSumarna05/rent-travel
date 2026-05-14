<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $published = fake()->boolean(80);

        return [
            'title' => fake()->unique()->sentence(6),
            'content' => fake()->paragraphs(6, true),
            'image' => null,
            'is_published' => $published,
            'published_at' => $published ? fake()->dateTimeBetween('-4 months', 'now') : null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => [
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-4 months', 'now'),
        ]);
    }
}
