@props(['label', 'name'])
@php($inputAttributes = $attributes->except('value'))

<label class="ut-label" for="{{ $name }}">{{ $label }}</label>
<input id="{{ $name }}" name="{{ $name }}" {{ $inputAttributes->merge(['class' => 'ut-input']) }} value="{{ old($name, $attributes->get('value')) }}">
@error($name)
    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
@enderror
