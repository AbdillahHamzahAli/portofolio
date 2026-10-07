@props(['post'])

<article {{ $attributes->class(['flex min-w-0 flex-col overflow-hidden rounded-card border border-hairline bg-surface-card']) }}>
    @if ($post->cover_path)
        <img src="{{ Storage::disk(\App\Models\Post::MEDIA_DISK)->url($post->cover_path) }}" alt="{{ $post->cover_alt ?? '' }}" loading="lazy" width="720" height="405" class="aspect-video w-full border-b border-hairline object-cover">
    @endif
    <div class="flex flex-1 flex-col p-6 sm:p-8">
        <time datetime="{{ $post->published_at->toDateString() }}" class="text-xs text-muted">{{ $post->published_at->locale('id')->translatedFormat('d F Y') }}</time>
        <h3 class="mt-6 text-[26px] leading-tight font-normal tracking-tight wrap-break-word">
            <a href="{{ route('blog.show', $post->slug) }}" class="decoration-hairline-strong underline-offset-4 hover:underline">{{ $post->title }}</a>
        </h3>
        @if ($post->excerpt)
            <p class="mt-4 line-clamp-3 text-sm leading-relaxed text-body">{{ $post->excerpt }}</p>
        @endif
        <div class="mt-auto pt-8">
            <a href="{{ route('blog.show', $post->slug) }}" aria-label="Baca artikel: {{ $post->title }}" class="inline-flex min-h-11 items-center gap-6 text-sm font-medium hover:underline">Baca artikel <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</article>
