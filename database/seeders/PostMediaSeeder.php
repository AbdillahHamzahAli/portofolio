<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Database\Seeder;

class PostMediaSeeder extends Seeder
{
    /**
     * Seed sample image metadata; no image files are created.
     */
    public function run(): void
    {
        $post = Post::query()->first() ?? Post::factory()->create();

        PostMedia::factory()->for($post)->count(3)->create();
    }
}
