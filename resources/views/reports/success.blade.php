<x-layouts.app title="Data Tersimpan">
    <div class="flex min-h-[calc(100vh-110px)] items-center px-6 py-10">
        <section class="w-full rounded-[2rem] bg-white px-7 py-12 text-center shadow-[0_20px_60px_rgba(17,17,17,0.08)]">
            <div class="mx-auto grid h-28 w-28 place-items-center rounded-full bg-green-100 ring-[14px] ring-green-50">
                <svg class="h-14 w-14 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <h1 class="mt-10 text-3xl font-bold text-[#111111]">Data Tersimpan</h1>
            <p class="mt-3 text-base font-medium text-gray-500">Laporan berhasil disimpan.</p>
            <a href="{{ route('history.index') }}" class="ut-button mt-12 w-full py-4 text-base">Lihat Histori</a>
        </section>
    </div>
</x-layouts.app>
