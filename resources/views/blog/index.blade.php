<x-layout title="Blog — Hamzah Ali Abdillah" description="Catatan Hamzah Ali Abdillah tentang backend, pengembangan perangkat lunak, robotika, dan proses belajar.">
    <section aria-labelledby="blog-title" class="grid gap-8 py-12 lg:grid-cols-12 lg:items-end lg:py-section">
        <div class="lg:col-span-8">
            <p class="mb-6 text-xs font-medium tracking-widest text-body uppercase">Blog pribadi / Hamzah Ali Abdillah</p>
            <h1 id="blog-title" class="text-[32px] leading-[1.1] font-normal tracking-tight sm:text-[56px] lg:text-hero">Belajar, membangun,<br>lalu berbagi.</h1>
        </div>
        <div class="lg:col-span-4 lg:pb-2">
            <p class="max-w-md text-base leading-relaxed text-body">Catatan tentang backend, robotika, dan hal-hal yang saya pelajari sepanjang perjalanan mengembangkan perangkat lunak.</p>
            <a href="{{ route('profile') }}" class="mt-5 inline-flex min-h-11 items-center gap-6 text-sm font-medium hover:underline">Tentang saya <span aria-hidden="true">↗</span></a>
        </div>
    </section>

    <section id="artikel" aria-labelledby="articles-title" class="border-t border-hairline py-12 lg:py-section">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <h2 id="articles-title" class="text-section font-normal">Catatan terbaru</h2>
            <span class="text-xs text-muted">Diurutkan dari publikasi terbaru</span>
        </div>
        @if ($posts->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <x-blog.post-card :post="$post" />
                @endforeach
            </div>
        @else
            <div class="rounded-card border border-hairline bg-surface-card px-6 py-16 text-center">
                <h3 class="text-2xl font-normal tracking-tight">{{ $posts->currentPage() > 1 ? 'Tidak ada artikel di halaman ini.' : 'Belum ada artikel yang terbit.' }}</h3>
                <p class="mt-4 text-sm text-body">{{ $posts->currentPage() > 1 ? 'Kembali ke halaman pertama untuk membaca catatan terbaru.' : 'Catatan baru akan hadir di sini. Sementara itu, kenali perjalanan saya melalui halaman profil.' }}</p>
                <a href="{{ $posts->currentPage() > 1 ? route('blog.index') : route('profile') }}" class="mt-6 inline-flex min-h-11 items-center rounded-control border border-hairline-strong px-5 text-sm font-medium hover:bg-canvas-soft">{{ $posts->currentPage() > 1 ? 'Kembali ke blog' : 'Lihat profil' }} ↗</a>
            </div>
        @endif
        @if ($posts->hasPages())
            <nav aria-label="Halaman artikel" class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-hairline pt-6 text-sm">
                @if ($posts->previousPageUrl())
                    <a href="{{ $posts->previousPageUrl() }}#artikel" rel="prev" class="inline-flex min-h-11 items-center rounded-control border border-hairline-strong px-4 hover:bg-surface-card">← Sebelumnya</a>
                @else
                    <span class="text-muted">Halaman pertama</span>
                @endif
                <span class="text-body">Halaman {{ $posts->currentPage() }}</span>
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}#artikel" rel="next" class="inline-flex min-h-11 items-center rounded-control border border-hairline-strong px-4 hover:bg-surface-card">Berikutnya →</a>
                @else
                    <span class="text-muted">Halaman terakhir</span>
                @endif
            </nav>
        @endif
    </section>
</x-layout>
