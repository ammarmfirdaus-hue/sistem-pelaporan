@props(['step' => 1, 'total' => 4])

@php($percent = (int) round(($step / $total) * 100))
<div class="ut-card">
    <div class="flex items-center gap-4">
        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5h6"/><path d="M9 3h6v4H9z"/><path d="M5 7h14v14H5z"/><path d="M9 12h6"/><path d="M9 16h4"/></svg>
        </span>
        <div class="min-w-0 flex-1">
            <h2 class="text-lg font-bold text-[#111111]">Sistem Pelaporan Mandiri</h2>
            <p class="text-sm font-medium text-gray-500">Progress Step {{ $step }}/{{ $total }}</p>
        </div>
    </div>
    <div class="mt-4 flex items-center gap-3">
        <div class="h-2 flex-1 rounded-full bg-gray-200">
            <div class="h-2 rounded-full bg-[#FFD900]" style="width: {{ $percent }}%"></div>
        </div>
        <span class="text-xs font-semibold text-gray-500">{{ $percent }}%</span>
    </div>
</div>
