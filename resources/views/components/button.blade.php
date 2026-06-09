@props(['variant' => 'primary'])

<button {{ $attributes->merge(['class' => $variant === 'secondary' ? 'ut-button-secondary' : 'ut-button']) }}>
    {{ $slot }}
</button>
