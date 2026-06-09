<x-layouts.app title="Histori Data">
    @php
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $activePeriodLabel = $selectedMonth && $selectedYear
            ? $monthNames[$selectedMonth].' '.$selectedYear
            : 'Semua laporan terbaru';
    @endphp

    <div class="flex min-h-[calc(100vh-5rem)] flex-col gap-5 bg-[#FAFAF8] px-4 pb-8 pt-5">
        <nav class="grid grid-cols-2 rounded-3xl border border-gray-100 bg-white p-1 shadow-sm">
            <a href="{{ route('reports.create') }}" class="rounded-2xl px-3 py-3 text-center text-sm font-semibold text-gray-500">
                Form Input
            </a>
            <a href="{{ route('history.index') }}" class="rounded-2xl border-b-4 border-[#FFD900] px-3 py-3 text-center text-sm font-semibold text-[#111111]">
                Histori Data
            </a>
        </nav>

        <form
            method="GET"
            action="{{ route('history.index') }}"
            class="rounded-3xl border border-gray-100 bg-white p-2 shadow-sm"
            x-data="{
                timer: null,
                submitSearch() {
                    clearTimeout(this.timer);
                    this.timer = setTimeout(() => this.$el.submit(), 300);
                }
            }"
        >
            @if ($selectedMonth && $selectedYear)
                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                <input type="hidden" name="year" value="{{ $selectedYear }}">
            @endif
            <div class="flex items-center gap-2">
                <label for="search" class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                </label>
                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ $search }}"
                    placeholder="Cari nama balita..."
                    class="min-w-0 flex-1 rounded-2xl border border-transparent bg-white px-1 py-3 text-sm font-medium text-[#111111] outline-none placeholder:text-gray-400 focus:border-[#FFD900] focus:ring-4 focus:ring-yellow-100"
                    x-on:input="submitSearch()"
                    x-on:search="submitSearch()"
                >
            </div>
        </form>

        <section x-data="{ openPeriod: false }">
            <div class="mb-3">
                <h2 class="text-base font-bold">Periode Laporan</h2>
                <p class="mt-1 text-xs font-medium text-gray-500">Menampilkan data berdasarkan bulan pencatatan laporan.</p>
            </div>
            <button
                type="button"
                x-on:click="openPeriod = true"
                class="flex h-14 w-full cursor-pointer items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 text-left text-sm font-semibold text-[#111111] shadow-sm transition hover:border-[#FFD900] focus:border-[#FFD900] focus:outline-none focus:ring-4 focus:ring-yellow-100 active:scale-[0.99]"
                aria-haspopup="dialog"
                x-bind:aria-expanded="openPeriod.toString()"
            >
                <span class="truncate">{{ $activePeriodLabel }}</span>
                <span class="ml-3 shrink-0 text-gray-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 2v4"/><path d="M16 2v4"/><path d="M3 10h18"/><path d="M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2z"/></svg>
                </span>
            </button>

            <div x-show="openPeriod" x-cloak class="fixed inset-0 z-50 bg-black/35" x-on:click.self="openPeriod = false">
                <div
                    class="absolute inset-x-0 bottom-0 rounded-t-[2rem] bg-white px-4 pb-[calc(1rem+env(safe-area-inset-bottom))] pt-4 shadow-[0_-18px_50px_rgba(17,17,17,0.18)] lg:left-1/2 lg:w-[430px] lg:-translate-x-1/2"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="translate-y-full"
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full"
                >
                    <div class="mx-auto mb-4 h-1.5 w-14 rounded-full bg-gray-200"></div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-[#111111]">Pilih Periode Laporan</h3>
                            <p class="mt-1 text-sm font-medium text-gray-500">Pilih bulan dan tahun pencatatan laporan.</p>
                        </div>
                        <button type="button" x-on:click="openPeriod = false" class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gray-100 text-gray-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>

                    <form method="GET" action="{{ route('history.index') }}" class="mt-5 space-y-4">
                        @if ($search)
                            <input type="hidden" name="search" value="{{ $search }}">
                        @endif

                        <div>
                            <label for="month" class="text-sm font-semibold text-[#111111]">Bulan</label>
                            <select id="month" name="month" class="mt-2 h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-[#111111] focus:border-[#FFD900] focus:ring-4 focus:ring-yellow-100">
                                @foreach ($monthNames as $value => $label)
                                    <option value="{{ $value }}" @selected((int) ($selectedMonth ?? now()->month) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="year" class="text-sm font-semibold text-[#111111]">Tahun</label>
                            <select id="year" name="year" class="mt-2 h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-[#111111] focus:border-[#FFD900] focus:ring-4 focus:ring-yellow-100">
                                @foreach ($yearOptions as $year)
                                    <option value="{{ $year }}" @selected((int) ($selectedYear ?? now()->year) === $year)>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <a href="{{ route('history.index', $search ? ['search' => $search] : []) }}" class="ut-button-secondary min-h-12">
                                Reset
                            </a>
                            <button type="submit" class="ut-button min-h-12">
                                Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="space-y-4">
            @forelse ($reports as $report)
                <x-history-card :report="$report" />
            @empty
                <div class="ut-card text-center">
                    <div class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-[#FFF6CC] text-[#8A6500]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5h6"/><path d="M5 7h14v14H5z"/><path d="M9 12h6"/></svg>
                    </div>
                    @if ($search)
                        <h3 class="mt-4 text-lg font-bold">Data tidak ditemukan</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Coba gunakan nama balita lain atau ubah periode laporan.</p>
                    @else
                        <h3 class="mt-4 text-lg font-bold">Belum ada laporan</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">Belum ada data pada periode ini. Silakan pilih periode lain atau input laporan baru.</p>
                    @endif
                    <a href="{{ route('reports.create') }}" class="ut-button mt-5 w-full">Input Laporan</a>
                </div>
            @endforelse
        </section>

        {{ $reports->links() }}

        <div class="mt-auto pb-[env(safe-area-inset-bottom)] pt-6">
            <a href="{{ route('reports.create') }}" class="ut-button-secondary min-h-12 w-full bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                Kembali
            </a>
        </div>
    </div>
</x-layouts.app>
