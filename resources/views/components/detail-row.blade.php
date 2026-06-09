@props(['label', 'value' => '-'])

<div class="grid grid-cols-[112px_1fr] gap-3">
    <dt class="font-semibold text-gray-500">{{ $label }}</dt>
    <dd class="font-bold text-[#111111]">{{ $value ?: '-' }}</dd>
</div>
