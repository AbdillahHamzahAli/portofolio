@props([
    'title' => 'Hamzah Ali Abdillah — Profile',
    'description' => 'Resume Hamzah Ali Abdillah, mahasiswa Informatika ITS dengan pengalaman backend development, REST API, dan robotika.',
])

<!DOCTYPE html>
<html lang="id" class="scheme-light scroll-smooth motion-reduce:scroll-auto dark:scheme-dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description }}">
        <title>{{ $title }}</title>
        <script>
            (() => {
                let theme = null;

                try {
                    theme = localStorage.getItem('theme');
                } catch {}

                document.documentElement.classList.toggle(
                    'dark',
                    theme === 'dark' || (theme !== 'light' && window.matchMedia('(prefers-color-scheme: dark)').matches),
                );
            })();
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-canvas font-sans text-ink antialiased selection:bg-hairline [&_a:focus-visible]:outline-2 [&_a:focus-visible]:outline-offset-4 [&_a:focus-visible]:outline-ink">
        <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-control focus:bg-ink focus:p-4 focus:text-canvas">Lewati ke konten</a>
        <header class="border-b border-hairline">
            <div class="relative mx-auto flex h-16 max-w-content items-center justify-between gap-6 px-6 lg:px-8">
                <a href="{{ route('blog.index') }}" aria-label="Hamzah Ali Abdillah, beranda blog" class="text-lg font-medium tracking-tight">hamzah<span class="text-primary">.</span></a>
                <nav aria-label="Navigasi utama" class="ml-auto hidden items-center gap-8 text-sm font-medium md:flex">
                    @unless (request()->routeIs('profile'))
                    <a href="{{ route('blog.index') }}" @if (request()->routeIs('blog.*')) aria-current="{{ request()->routeIs('blog.index') ? 'page' : 'true' }}" @endif @class(['decoration-hairline-strong underline-offset-8 hover:underline', 'underline' => request()->routeIs('blog.*')])>Blog</a>
                    @endunless
                    <a href="{{ route('profile') }}" @if (request()->routeIs('profile')) aria-current="page" @endif @class(['decoration-hairline-strong underline-offset-8 hover:underline', 'underline' => request()->routeIs('profile')])>Profil</a>
                    @if (request()->routeIs('profile'))
                        <a href="#pengalaman" class="hover:underline hover:underline-offset-8">Pengalaman</a>
                        <a href="#pendidikan" class="hover:underline hover:underline-offset-8">Pendidikan</a>
                        <a href="#kontak" class="hover:underline hover:underline-offset-8">Kontak ↗</a>
                    @endif
                </nav>
                <div class="flex items-center gap-3">
                    <x-theme-toggle />
                    <details class="group md:hidden">
                        <summary aria-label="Menu navigasi" class="flex min-h-11 min-w-11 cursor-pointer list-none items-center justify-center rounded-control border border-hairline text-2xl [&::-webkit-details-marker]:hidden"><span aria-hidden="true">☰</span></summary>
                        <nav aria-label="Navigasi seluler" class="absolute inset-x-6 top-16 z-20 flex flex-col rounded-card border border-hairline bg-canvas p-4 text-sm [&_a]:px-3 [&_a]:py-3">
                            @unless (request()->routeIs('profile'))
                            <a href="{{ route('blog.index') }}" @if (request()->routeIs('blog.index')) aria-current="page" @endif>Blog</a>
                            @endunless
                            <a href="{{ route('profile') }}" @if (request()->routeIs('profile')) aria-current="page" @endif>Profil</a>
                            @if (request()->routeIs('profile'))
                                <a href="#pengalaman">Pengalaman</a>
                                <a href="#pendidikan">Pendidikan</a>
                                <a href="#kontak">Kontak ↗</a>
                            @endif
                        </nav>
                    </details>
                </div>
            </div>
        </header>
        <main id="main" {{ $attributes->class(['mx-auto max-w-content px-6 lg:px-8']) }}>
            {{ $slot }}
        </main>
        <footer class="border-t border-hairline">
            <div class="mx-auto flex max-w-content flex-col justify-between gap-4 px-6 py-12 text-sm text-body sm:flex-row lg:px-8">
                <p>© {{ date('Y') }} Hamzah Ali Abdillah</p>
                <a href="#main" class="text-ink hover:underline">Kembali ke atas ↑</a>
            </div>
        </footer>
    </body>
</html>
