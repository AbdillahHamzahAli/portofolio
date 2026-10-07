<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PostMedia>
 */
class PostMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'disk' => Post::MEDIA_DISK,
            'path' => fn (array $attributes) => 'blog/'.$attributes['post_id'].'/images/'.fake()->uuid().'.jpg',
            'original_name' => 'image.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'alt_text' => null,
        ];
    }
}
