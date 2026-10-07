@props(['title', 'description'])

<x-layout :title="$title.' — Admin'" :description="$description">
    <section class="mx-auto max-w-md py-16 lg:py-section">
        <p class="mb-4 text-xs tracking-widest text-muted uppercase">Admin / Blog pribadi</p>
        <h1 class="text-section font-normal">{{ $title }}</h1>
        <p class="mt-4 text-sm leading-relaxed text-body">{{ $description }}</p>
        @if (session('status'))
            <p role="status" class="mt-6 rounded-control border border-hairline bg-surface-card p-4 text-sm text-body">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div role="alert" class="mt-6 rounded-control border border-hairline bg-surface-card p-4 text-sm text-ink">
                <ul class="list-disc space-y-2 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mt-8 rounded-card border border-hairline bg-surface-card p-6">{{ $slot }}</div>
    </section>
</x-layout>
