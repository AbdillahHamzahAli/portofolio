@props(['id', 'number', 'title', 'description' => null])

<section id="{{ $id }}" aria-labelledby="{{ $id }}-title" {{ $attributes->class(['scroll-mt-8 border-t border-hairline py-12 lg:py-section']) }}>
    <div class="grid gap-8 lg:grid-cols-12 lg:gap-12">
        <header class="lg:col-span-4">
            <p class="mb-4 text-xs text-muted">{{ $number }} / RESUME</p>
            <h2 id="{{ $id }}-title" class="text-section font-normal">{{ $title }}</h2>
            @if ($description)
                <p class="mt-4 max-w-xs text-sm leading-relaxed text-body">{{ $description }}</p>
            @endif
        </header>
        <div class="min-w-0 lg:col-span-8">{{ $slot }}</div>
    </div>
</section>
