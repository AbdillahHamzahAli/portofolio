<?php

use App\Models\Post;
use App\Models\PostMedia;
use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

uses(LazilyRefreshDatabase::class);

test('posts and media belong only to their respective owners', function () {
    $author = User::factory()->create();
    $post = Post::factory()->for($author)->create();
    $media = PostMedia::factory()->for($post)->create();
    PostMedia::factory()->create();

    $post->load('user', 'media');

    expect($author->posts->modelKeys())->toBe([$post->id]);
    expect($post->user->is($author))->toBeTrue();
    expect($post->media->modelKeys())->toBe([$media->id]);
    expect($media->post->is($post))->toBeTrue();
});

// test('publication requires published status and a timestamp at or before now', function (PostStatus $status, ?string $publishedAt, bool $visible) {
//     $this->travelTo(Carbon::parse('2026-10-07 12:00:00'));
//     $post = Post::factory()->create(['status' => $status, 'published_at' => $publishedAt]);
//
//     $posts = Post::published()->get();
//
//     expect($posts->modelKeys())->toBe($visible ? [$post->id] : []);
// })->with([
//     'draft without timestamp' => [PostStatus::Draft, null, false],
//     'draft with past timestamp' => [PostStatus::Draft, '2026-10-07 11:59:59', false],
//     'published without timestamp' => [PostStatus::Published, null, false],
//     'published in the past' => [PostStatus::Published, '2026-10-07 11:59:59', true],
//     'published exactly now' => [PostStatus::Published, '2026-10-07 12:00:00', true],
//     'scheduled in the future' => [PostStatus::Published, '2026-10-07 12:00:01', false],
// ]);

test('new posts default to draft with optional metadata absent', function () {
    $author = User::factory()->create();

    $post = $author->posts()->create([
        'title' => 'First post',
        'slug' => 'first-post',
        'body' => '<p>Safe HTML.</p>',
    ])->refresh();

    expect($post->status)->toBe(PostStatus::Draft);
    expect($post->published_at)->toBeNull();
    expect($post->excerpt)->toBeNull();
    expect($post->cover_path)->toBeNull();
    expect($post->cover_alt)->toBeNull();
});

test('post slugs must be unique', function () {
    $post = Post::factory()->create(['slug' => 'unique-post']);

    expect(fn () => Post::factory()->for($post->user)->create(['slug' => 'unique-post']))
        ->toThrow(UniqueConstraintViolationException::class);
});

test('media paths must be unique', function () {
    $media = PostMedia::factory()->create();

    expect(fn () => PostMedia::factory()->for($media->post)->create(['path' => $media->path]))
        ->toThrow(UniqueConstraintViolationException::class);
});

// test('covers and inline images use post-specific paths on the public disk', function () {
//     Storage::fake('public');
//     $post = Post::factory()->create();
//     $coverPath = $post->coversDirectory().'/cover.jpg';
//     $imagePath = $post->imagesDirectory().'/image.jpg';
//
//     Storage::disk(Post::MEDIA_DISK)->put($coverPath, 'cover');
//     Storage::disk(Post::MEDIA_DISK)->put($imagePath, 'image');
//     $post->update(['cover_path' => $coverPath]);
//     $media = $post->media()->create([
//         'path' => $imagePath,
//         'original_name' => 'image.jpg',
//         'mime_type' => 'image/jpeg',
//         'size' => 5,
//     ])->refresh();
//
//     Storage::disk('public')->assertExists([
//         "blog/{$post->id}/covers/cover.jpg",
//         "blog/{$post->id}/images/image.jpg",
//     ]);
//     expect($post->fresh()->cover_path)->toBe("blog/{$post->id}/covers/cover.jpg");
//     expect($media->path)->toBe("blog/{$post->id}/images/image.jpg");
//     expect($media->disk)->toBe('public');
//     expect($media->size)->toBe(5);
// });
