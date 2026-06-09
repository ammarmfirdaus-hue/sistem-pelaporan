@props(['report'])

@php
    $child = $report->child;
    $mother = $report->mother;
    $age = $child ? $child->age_display : '-';
    $gender = $child?->jenis_kelamin === 'perempuan' ? 'Perempuan' : 'Laki-laki';
@endphp

<article class="ut-card">
    <div class="flex items-start gap-3">
        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#FFF4C7] text-[#8A6500]">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8"/><path d="M9 10h.01M15 10h.01M9 15c1.8 1.2 4.2 1.2 6 0"/><path d="M12 4V2"/></svg>
        </span>
        <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between gap-2 min-w-0">
                <div class="min-w-0 flex-1">
                    <h3 class="truncate text-lg font-bold text-[#111111]">{{ $child?->nama }}</h3>
                    <p class="text-sm font-medium text-gray-500">Bayi {{ $gender }} &bull; {{ $age }}</p>
                </div>
                <x-status-badge class="shrink-0">Tersimpan</x-status-badge>
            </div>
        </div>
    </div>

    <div class="mt-4 divide-y divide-gray-100 border-y border-gray-100 text-sm">
        <div class="grid grid-cols-2 gap-4 py-3">
            <div>
                <p class="text-xs font-bold text-gray-500">Tanggal Input</p>
                <p class="font-semibold text-gray-800">{{ $report->created_at->timezone(config('app.timezone'))->translatedFormat('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-500">Posyandu</p>
                <p class="font-semibold text-gray-800">{{ $report->posyandu?->nama_posyandu }}</p>
            </div>
        </div>
        <div class="py-3">
            <p class="text-xs font-bold text-gray-500">Nama Ibu</p>
            <p class="font-semibold text-gray-800">{{ $mother?->nama }}</p>
        </div>
    </div>

    <a href="{{ route('history.show', $report) }}" class="mt-4 flex items-center justify-end gap-2 text-sm font-semibold text-[#8A6500]">
        Lihat Detail
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
    </a>
</article>
