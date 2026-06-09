<div
    x-show="showConfirmPosyandu"
    x-cloak
    class="fixed inset-0 z-50 flex items-end justify-center bg-[#111111]/35 px-0 lg:left-1/2 lg:w-[430px] lg:-translate-x-1/2"
    x-transition.opacity
>
    <div
        x-show="showConfirmPosyandu"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0"
        class="w-full rounded-t-[2rem] bg-white px-6 pb-6 pt-4 shadow-[0_-18px_50px_rgba(17,17,17,0.16)]"
    >
        <div class="mx-auto mb-6 h-1.5 w-16 rounded-full bg-gray-300"></div>
        <div class="flex items-start gap-4">
            <span class="grid h-16 w-16 shrink-0 place-items-center rounded-full bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            </span>
            <div>
                <h2 class="text-2xl font-bold leading-snug text-[#111111]">Ubah Identitas Posyandu?</h2>
                <p class="mt-3 text-sm font-medium leading-6 text-gray-500">Gunakan menu ini jika Anda dialihkan ke posyandu lain. Perubahan akan dipakai untuk laporan berikutnya.</p>
            </div>
        </div>
        <div class="mt-7 grid grid-cols-2 gap-3">
            <button type="button" x-on:click="showConfirmPosyandu = false" class="ut-button-secondary py-4 text-base">
                Batal
            </button>
            <button type="button" x-on:click="showConfirmPosyandu = false; showEditPosyandu = true" class="ut-button py-4 text-base">
                Lanjutkan
            </button>
        </div>
    </div>
</div>

<div
    x-show="showEditPosyandu"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto bg-[#FAFAF8] lg:left-1/2 lg:w-[430px] lg:-translate-x-1/2"
    x-transition.opacity
>
    <form method="POST" action="{{ route('posyandu.identity.update') }}" class="flex min-h-screen flex-col">
        @csrf
        @method('PATCH')

        <div class="px-4 pb-28 pt-5">
            <section class="ut-card">
                <div class="flex items-start gap-4">
                    <span class="grid h-16 w-16 shrink-0 place-items-center rounded-3xl bg-[#FFF6CC] text-[#8A6500]">
                        <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V8l7-5 7 5v13"/><path d="M9 21v-6h6v6"/><path d="m16 14 4 4"/><path d="m20 14-4 4"/></svg>
                    </span>
                    <div>
                        <h2 class="text-2xl font-bold leading-snug text-[#111111]">Edit Identitas Posyandu</h2>
                        <p class="mt-2 text-sm font-medium leading-6 text-gray-500">Perbarui data posyandu jika Anda dialihkan ke lokasi lain.</p>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3 rounded-2xl border border-[#FFD900]/50 bg-[#FFF9DE] px-4 py-3 text-sm font-semibold text-[#7A5A00]">
                    <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#FFD900] text-[#111111]">i</span>
                    <span>Perubahan akan digunakan untuk laporan berikutnya.</span>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <x-input label="Nama Posyandu" name="nama_posyandu" value="{{ old('nama_posyandu', $posyandu->nama_posyandu) }}" placeholder="Masukkan nama posyandu" />
                        @error('nama_posyandu', 'posyanduIdentity') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <x-input label="Kecamatan" name="kecamatan" value="{{ old('kecamatan', $posyandu->kecamatan) }}" placeholder="Masukkan kecamatan" />
                        @error('kecamatan', 'posyanduIdentity') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <x-input label="Kelurahan" name="kelurahan" value="{{ old('kelurahan', $posyandu->kelurahan) }}" placeholder="Masukkan kelurahan" />
                        @error('kelurahan', 'posyanduIdentity') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <x-input label="Kode Internal" name="kode_internal_display" value="{{ $posyandu->kode_internal }}" disabled class="ut-input bg-gray-50 text-gray-500" />
                        <p class="mt-2 text-xs font-semibold text-gray-500">Kode internal tidak dapat diubah.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="fixed inset-x-0 bottom-0 z-10 border-t border-gray-100 bg-[#FAFAF8]/95 px-4 py-4 backdrop-blur lg:bottom-8 lg:left-1/2 lg:w-[430px] lg:-translate-x-1/2 lg:rounded-b-[2rem]">
            <div class="flex gap-3">
                <button type="button" x-on:click="showEditPosyandu = false" class="ut-button-secondary flex-1 py-4 text-base">
                    Batal
                </button>
                <button type="submit" class="ut-button flex-1 py-4 text-base">
                    Simpan Perubahan
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
        </div>
    </form>
</div>
