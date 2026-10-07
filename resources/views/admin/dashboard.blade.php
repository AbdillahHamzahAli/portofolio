<x-layout title="Admin — Hamzah Ali Abdillah" description="Panel administrasi blog pribadi.">
    <section class="py-12 lg:py-section">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="mb-4 text-xs tracking-widest text-muted uppercase">Admin panel</p>
                <h1 class="text-section font-normal">Selamat datang, {{ auth()->user()->name }}.</h1>
                <p class="mt-4 text-body">Autentikasi admin sudah aktif. Pengelolaan artikel akan ditambahkan pada tahap berikutnya.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="min-h-11 cursor-pointer rounded-control border border-hairline-strong bg-surface-card px-5 text-sm font-medium focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ink">Keluar ↗</button>
            </form>
        </div>
    </section>
</x-layout>
