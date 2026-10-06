@props(['company', 'role', 'period', 'location' => null, 'description' => null])

<article {{ $attributes->class(['rounded-card border border-hairline bg-surface-card p-6']) }}>
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:gap-6">
        <div>
            <h3 class="text-lg font-semibold leading-snug">{{ $company }}</h3>
            <p class="mt-1 text-sm text-body">{{ $role }}</p>
        </div>
        <p class="shrink-0 text-xs leading-6 text-body">{{ $period }}</p>
    </div>
    @if ($location)
        <p class="mt-3 text-xs text-muted">{{ $location }}</p>
    @endif
    @if ($description)
        <p class="mt-4 text-sm leading-relaxed text-body">{{ $description }}</p>
    @endif
    <ul class="mt-4 flex list-disc flex-col gap-2 pl-4 text-sm leading-relaxed text-body marker:text-hairline-strong">{{ $slot }}</ul>
</article>
