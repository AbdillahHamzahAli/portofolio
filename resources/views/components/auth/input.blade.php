@props(['name', 'label', 'type' => 'text'])

<div>
    <label for="{{ $name }}" class="mb-2 block text-sm font-medium">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" @if ($errors->has($name)) aria-invalid="true" @endif {{ $attributes->class(['min-h-11 w-full rounded-control border border-hairline-strong bg-canvas px-4 py-3 text-sm text-ink focus:outline-2 focus:outline-offset-2 focus:outline-ink']) }}>
</div>
