<div class="space-y-5">
    @if ($user->posyandu)
        <x-form-card>
            <div class="flex items-start gap-4">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V8l7-5 7 5v13"/><path d="M9 21v-6h6v6"/></svg>
                </span>
                <div class="min-w-0 flex-1">
                    <h2 class="text-xl font-bold leading-snug">Identitas Posyandu</h2>
                    <p class="mt-1 text-sm font-medium text-gray-500">Data posyandu untuk laporan.</p>
                </div>
                <button type="button" x-on:click="showConfirmPosyandu = true" class="rounded-full bg-[#FFD900]/20 px-3 py-1.5 text-sm font-semibold text-[#7A5A00] transition hover:bg-[#FFD900]/35">
                    Ubah
                </button>
            </div>
            <dl class="mt-5 grid gap-3 rounded-2xl bg-[#FAFAF8] p-4 text-sm">
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Nama Posyandu</dt><dd class="text-right font-bold">{{ $user->posyandu->nama_posyandu }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Kecamatan</dt><dd class="text-right font-bold">{{ $user->posyandu->kecamatan }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Kelurahan</dt><dd class="text-right font-bold">{{ $user->posyandu->kelurahan }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Kode Internal</dt><dd class="text-right font-bold">{{ $user->posyandu->kode_internal }}</dd></div>
            </dl>
        </x-form-card>
    @else
        <x-form-card>
            <div class="flex items-start gap-4">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V8l7-5 7 5v13"/><path d="M9 21v-6h6v6"/></svg>
                </span>
                <div>
                    <h2 class="text-xl font-bold leading-snug">Identitas Posyandu</h2>
                    <p class="mt-1 text-sm font-medium text-gray-500">Lengkapi informasi posyandu tempat kegiatan.</p>
                </div>
            </div>
            <div class="mt-5 space-y-4">
                <div>
                    <x-input label="Nama Posyandu" name="nama_posyandu" placeholder="Masukkan nama posyandu" x-model="form.nama_posyandu" />
                    <p x-show="errors.nama_posyandu" x-cloak x-text="errors.nama_posyandu" class="mt-1 text-xs font-semibold text-red-600"></p>
                </div>
                <div>
                    <x-input label="Kecamatan" name="kecamatan" placeholder="Masukkan kecamatan" x-model="form.kecamatan" />
                    <p x-show="errors.kecamatan" x-cloak x-text="errors.kecamatan" class="mt-1 text-xs font-semibold text-red-600"></p>
                </div>
                <div>
                    <x-input label="Kelurahan" name="kelurahan" placeholder="Masukkan kelurahan" x-model="form.kelurahan" />
                    <p x-show="errors.kelurahan" x-cloak x-text="errors.kelurahan" class="mt-1 text-xs font-semibold text-red-600"></p>
                </div>
                <p class="rounded-2xl bg-[#FFF7D6] px-4 py-3 text-xs font-semibold text-[#7A5A00]">
                    ID Posyandu akan dibuat otomatis setelah data pertama kali disimpan.
                </p>
            </div>
        </x-form-card>
    @endif

    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M6 21v-2a6 6 0 0 1 12 0v2"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Petugas Posyandu</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Lengkapi informasi petugas posyandu.</p>
            </div>
        </div>
        <div class="mt-5 space-y-4">
            <x-input label="Nama Petugas" name="nama_petugas_display" value="{{ $user->name }}" readonly class="ut-input bg-gray-50" />
            <div>
                <x-input label="No HP Petugas" name="no_hp_petugas" placeholder="Contoh: 081234567890" x-model="form.no_hp_petugas" />
                <p x-show="errors.no_hp_petugas" x-cloak x-text="errors.no_hp_petugas" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
        </div>
    </x-form-card>
</div>
