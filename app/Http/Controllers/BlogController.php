<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->published()
            ->select(['id', 'title', 'slug', 'excerpt', 'cover_path', 'cover_alt', 'published_at'])
            ->latest('published_at')
            ->latest('id')
            ->simplePaginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = Post::query()->published()->with('user:id,name')->where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('post'));
    }
}
