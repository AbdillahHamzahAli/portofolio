<button
    type="button"
    data-theme-toggle
    aria-label="Mode gelap"
    aria-pressed="false"
    hidden
    {{ $attributes->class(['inline-flex min-h-11 min-w-11 cursor-pointer items-center justify-center rounded-control border border-hairline bg-canvas hover:bg-surface-card focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ink']) }}
>
    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="size-5 dark:hidden">
        <path d="M20.5 13a8.5 8.5 0 0 1-9.5-9.5A8.5 8.5 0 1 0 20.5 13Z" />
    </svg>
    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="hidden size-5 dark:block">
        <circle cx="12" cy="12" r="4" />
        <path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.5 1.5m11 11L19 19M5 19l1.5-1.5m11-11L19 5" />
    </svg>
</button>
