<x-layouts.app title="Detail Laporan">
    @php
        $child = $report->child;
        $age = $child ? $child->age_display : '-';
    @endphp

    <div class="flex min-h-[calc(100vh-5rem)] flex-col gap-5 px-4 pb-8 pt-5">
        <div class="space-y-5">
            <section class="ut-card">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <!-- <p class="text-sm font-semibold text-[#8A6500]">Detail Laporan</p> -->
                        <h1 class="mt-1 text-2xl font-bold text-[#111111]">{{ $child?->nama }}</h1>
                        <p class="mt-1 text-sm font-medium text-gray-500">{{ ucfirst($child?->jenis_kelamin) }} &bull; {{ $age }}</p>
                    </div>
                    <x-status-badge>Tersimpan</x-status-badge>
                </div>
            </section>

            <x-form-card>
                <h2 class="text-lg font-bold">Ringkasan Bayi</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <x-detail-row label="Nama bayi" :value="$child?->nama" />
                    <x-detail-row label="Jenis kelamin" :value="ucfirst($child?->jenis_kelamin)" />
                    <x-detail-row label="Tanggal lahir" :value="$child?->tanggal_lahir?->format('d M Y')" />
                    <x-detail-row label="Usia" :value="$age" />
                </dl>
            </x-form-card>

            <x-form-card>
                <h2 class="text-lg font-bold">Identitas Posyandu</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <x-detail-row label="Nama posyandu" :value="$report->posyandu?->nama_posyandu" />
                    <x-detail-row label="Kode internal" :value="$report->posyandu?->kode_internal" />
                    <x-detail-row label="Kecamatan" :value="$report->posyandu?->kecamatan" />
                    <x-detail-row label="Kelurahan" :value="$report->posyandu?->kelurahan" />
                </dl>
            </x-form-card>

            <x-form-card>
                <h2 class="text-lg font-bold">Petugas</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <x-detail-row label="Nama petugas" :value="$report->nama_petugas" />
                    <x-detail-row label="No HP petugas" :value="$report->no_hp_petugas" />
                    <x-detail-row label="Tanggal input" :value="$report->created_at->timezone(config('app.timezone'))->format('d M Y, H:i')" />
                </dl>
            </x-form-card>

            <x-form-card>
                <h2 class="text-lg font-bold">Identitas Orang Tua</h2>
                <div class="mt-4 rounded-2xl bg-[#FAFAF8] p-4">
                    <h3 class="font-bold">Ayah</h3>
                    <dl class="mt-3 space-y-3 text-sm">
                        <x-detail-row label="Nama" :value="$report->father?->nama" />
                        <x-detail-row label="Alamat" :value="$report->father?->alamat" />
                        <x-detail-row label="No HP" :value="$report->father?->no_hp" />
                    </dl>
                </div>
                <div class="mt-3 rounded-2xl bg-[#FAFAF8] p-4">
                    <h3 class="font-bold">Ibu</h3>
                    <dl class="mt-3 space-y-3 text-sm">
                        <x-detail-row label="Nama" :value="$report->mother?->nama" />
                        <x-detail-row label="Alamat" :value="$report->mother?->alamat" />
                        <x-detail-row label="No HP" :value="$report->mother?->no_hp" />
                    </dl>
                </div>
            </x-form-card>

            <x-form-card>
                <h2 class="text-lg font-bold">Hasil Pengukuran</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <x-detail-row label="Berat badan" value="{{ $report->measurement?->berat_badan }} kg" />
                    <x-detail-row label="Tinggi badan" value="{{ $report->measurement?->tinggi_badan }} cm" />
                    <x-detail-row label="Lingkar kepala" value="{{ $report->measurement?->lingkar_kepala }} cm" />
                </dl>
            </x-form-card>

            <x-form-card>
                <h2 class="text-lg font-bold">Tindakan Tambahan</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <x-detail-row label="Imunisasi" :value="$report->measurement?->imunisasi ?: '-'" />
                    <x-detail-row label="Vitamin A" :value="$report->measurement?->beri_vitamin_a ? 'Ya' : 'Tidak'" />
                    <x-detail-row label="Obat cacing" :value="$report->measurement?->beri_obat_cacing ? 'Ya' : 'Tidak'" />
                </dl>
            </x-form-card>
        </div>

        <div class="mt-auto pb-[env(safe-area-inset-bottom)] pt-6">
            <a href="{{ route('history.index') }}" class="ut-button-secondary min-h-12 w-full bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                Kembali
            </a>
        </div>
    </div>
</x-layouts.app>
