<x-layouts.admin title="Dashboard Admin">
    <div class="space-y-6">
        <section class="rounded-[28px] border border-black/5 bg-white p-6 shadow-[0_18px_55px_rgba(17,17,17,0.06)] lg:p-8">
            <div class="max-w-3xl">
                <p class="text-sm font-semibold text-[#8A6500]">Selamat datang, {{ auth()->user()?->name }}.</p>
                <h2 class="mt-3 text-3xl font-bold leading-tight text-[#111111] lg:text-4xl">Fondasi admin siap dikembangkan</h2>
                <p class="mt-4 text-base font-medium leading-7 text-gray-500">
                    Area ini disiapkan sebagai pintu masuk admin. Dashboard penuh, tabel data, dan monitoring pertumbuhan akan dikembangkan pada step berikutnya.
                </p>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['title' => 'Total Posyandu', 'desc' => 'Segera tersedia'],
                ['title' => 'Total Petugas', 'desc' => 'Segera tersedia'],
                ['title' => 'Total Laporan', 'desc' => 'Segera tersedia'],
                ['title' => 'Monitoring Pertumbuhan', 'desc' => 'Segera tersedia'],
            ] as $card)
                <div class="rounded-[24px] border border-black/5 bg-white p-5 shadow-sm">
                    <div class="grid h-11 w-11 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19V5"/><path d="M9 19v-8"/><path d="M14 19v-5"/><path d="M19 19V8"/></svg>
                    </div>
                    <h3 class="mt-4 text-base font-bold text-[#111111]">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-sm font-medium text-gray-500">{{ $card['desc'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="rounded-[28px] border border-dashed border-[#D6A900]/40 bg-[#FFFDF0] p-6">
            <h3 class="text-lg font-bold text-[#111111]">Catatan pengembangan</h3>
            <p class="mt-2 text-sm font-medium leading-6 text-gray-600">
                Placeholder ini hanya memvalidasi area admin desktop dan proteksi role. Fitur administrasi lengkap belum diaktifkan.
            </p>
        </section>
    </div>
</x-layouts.admin>
