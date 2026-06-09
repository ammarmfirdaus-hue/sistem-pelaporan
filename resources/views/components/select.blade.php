@props(['label', 'name'])

<label class="ut-label" for="{{ $name }}">{{ $label }}</label>
<select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'ut-input']) }}>
    {{ $slot }}
</select>
@error($name)
    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
@enderror
