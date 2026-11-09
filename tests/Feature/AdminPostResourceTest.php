<?php

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Livewire;

uses(LazilyRefreshDatabase::class);

test('only administrators can access the Filament post resource', function () {
    $ordinaryUser = User::factory()->create();
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($ordinaryUser)->get('/admin/posts')->assertForbidden();
    $this->actingAs($admin)->get('/admin/posts')->assertOk();
});

test('posts created through the resource belong to the authenticated administrator', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin);

    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Artikel Filament',
            'slug' => 'artikel-filament',
            'excerpt' => 'Ringkasan artikel.',
            'body' => '<p>Isi artikel.</p>',
            'status' => PostStatus::Draft->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $post = Post::query()->where('slug', 'artikel-filament')->firstOrFail();

    expect($post->user_id)->toBe($admin->id)
        ->and($post->status)->toBe(PostStatus::Draft)
        ->and($post->published_at)->toBeNull();
});

test('published posts receive their publication date automatically', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin);

    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Artikel Terbit',
            'slug' => 'artikel-terbit',
            'excerpt' => 'Deskripsi artikel.',
            'body' => '<p>Isi artikel.</p>',
            'status' => PostStatus::Published->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $post = Post::query()->where('slug', 'artikel-terbit')->firstOrFail();

    expect($post->status)->toBe(PostStatus::Published)
        ->and($post->published_at)->not->toBeNull();
});
