<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('the homepage lists only public articles in newest publication order', function () {
    $this->freezeTime();
    $author = User::factory()->create();
    $older = Post::factory()->for($author)->published()->create(['published_at' => now()->subDay()]);
    $newer = Post::factory()->for($author)->published()->create();
    $draft = Post::factory()->for($author)->create();
    $scheduled = Post::factory()->for($author)->scheduled()->create();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSeeInOrder([$newer->title, $older->title])
        ->assertSee(route('blog.show', $newer->slug))
        ->assertDontSee($draft->title)
        ->assertDontSee($scheduled->title);
});

test('the homepage explains when no articles have been published', function () {
    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('Belum ada artikel yang terbit.')
        ->assertSee(route('profile'));
});

test('public articles are paginated without repeating records', function () {
    $this->freezeTime();
    $posts = Post::factory()->for(User::factory())->published()->count(10)->create();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('Berikutnya')
        ->assertSee($posts->last()->title)
        ->assertDontSee($posts->first()->title);

    $this->get(route('blog.index', ['page' => 2]))
        ->assertOk()
        ->assertSee($posts->first()->title)
        ->assertDontSee($posts->last()->title);
});

test('a public article renders rich text and escapes its plain text metadata', function () {
    $post = Post::factory()->published()->create([
        'title' => '<script>alert("title")</script>',
        'excerpt' => '<script>alert("excerpt")</script>',
        'body' => '<h2>Memulai backend</h2><p>Konten artikel yang sudah disanitasi.</p>',
        'cover_path' => 'blog/cover.jpg',
        'cover_alt' => 'Gambar sampul artikel',
    ]);

    $this->get(route('blog.show', $post->slug))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee($post->excerpt)
        ->assertDontSee($post->title, false)
        ->assertDontSee($post->excerpt, false)
        ->assertSee($post->body, false)
        ->assertSee($post->user->name)
        ->assertSee('Gambar sampul artikel');
});

test('scheduled articles cannot be opened directly before publication', function () {
    $this->freezeTime();
    $post = Post::factory()->scheduled()->create();

    $this->get(route('blog.show', $post->slug))->assertNotFound();
});

test('draft and missing articles return not found', function () {
    $post = Post::factory()->create();

    $this->get(route('blog.show', $post->slug))->assertNotFound();
    $this->get(route('blog.show', 'artikel-tidak-ada'))->assertNotFound();
});
