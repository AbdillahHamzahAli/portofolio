<x-layout :title="$post->title.' — Hamzah Ali Abdillah'" :description="$post->excerpt ?? $post->title">
    <article class="mx-auto max-w-3xl py-12 lg:py-section">
        <a href="{{ route('blog.index') }}" class="inline-flex min-h-11 items-center gap-3 text-sm text-body hover:text-ink hover:underline">← Semua artikel</a>
        <header class="mt-8 border-b border-hairline pb-10">
            <time datetime="{{ $post->published_at->toDateString() }}" class="text-xs text-muted">{{ $post->published_at->locale('id')->translatedFormat('d F Y') }}</time>
            <h1 class="mt-5 text-[32px] leading-tight font-normal tracking-tight wrap-break-word sm:text-5xl">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="mt-6 text-lg leading-relaxed text-body">{{ $post->excerpt }}</p>
            @endif
            <p class="mt-6 text-sm text-body">Ditulis oleh {{ $post->user->name }}</p>
        </header>
        @if ($post->cover_path)
            <img src="{{ Storage::disk(\App\Models\Post::MEDIA_DISK)->url($post->cover_path) }}" alt="{{ $post->cover_alt ?? '' }}" width="1200" height="675" class="mt-10 aspect-video w-full rounded-card border border-hairline object-cover">
        @endif
        <div class="mt-10 text-base leading-8 wrap-break-word text-body [&_a]:text-ink [&_a]:underline [&_a]:underline-offset-4 [&_blockquote]:my-8 [&_blockquote]:border-l-2 [&_blockquote]:border-hairline-strong [&_blockquote]:pl-6 [&_blockquote]:italic [&_code]:rounded [&_code]:bg-canvas-soft [&_code]:px-1 [&_code]:font-mono [&_code]:text-[13px] [&_h2]:mt-12 [&_h2]:mb-5 [&_h2]:text-[26px] [&_h2]:leading-tight [&_h2]:font-normal [&_h2]:tracking-tight [&_h2]:text-ink [&_h3]:mt-8 [&_h3]:mb-4 [&_h3]:text-[22px] [&_h3]:font-normal [&_h3]:text-ink [&_img]:my-8 [&_img]:h-auto [&_img]:max-w-full [&_img]:rounded-card [&_li]:my-2 [&_ol]:my-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_p]:my-5 [&_pre]:my-8 [&_pre]:overflow-x-auto [&_pre]:rounded-card [&_pre]:border [&_pre]:border-hairline [&_pre]:bg-surface-card [&_pre]:p-5 [&_pre]:font-mono [&_pre]:text-[13px] [&_pre]:leading-relaxed [&_strong]:font-semibold [&_strong]:text-ink [&_table]:block [&_table]:overflow-x-auto [&_td]:border [&_td]:border-hairline [&_td]:p-3 [&_th]:border [&_th]:border-hairline [&_th]:p-3 [&_ul]:my-6 [&_ul]:list-disc [&_ul]:pl-6">
            {!! $post->body !!}
        </div>
        <footer class="mt-16 border-t border-hairline pt-8">
            <a href="{{ route('blog.index') }}" class="inline-flex min-h-11 items-center gap-6 rounded-control border border-hairline-strong px-5 text-sm font-medium hover:bg-surface-card">← Kembali ke blog</a>
        </footer>
    </article>
</x-layout>
