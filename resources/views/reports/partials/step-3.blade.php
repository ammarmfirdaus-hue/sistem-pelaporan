<x-form-card>
    <div class="flex items-start gap-4">
        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFD900] text-[#111111]">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8"/><path d="M9 10h.01M15 10h.01M9 15c1.8 1.2 4.2 1.2 6 0"/><path d="M12 4V2"/></svg>
        </span>
        <div>
            <h2 class="text-xl font-bold leading-snug">Identitas Bayi / Balita</h2>
            <p class="mt-1 text-sm font-medium text-gray-500">Lengkapi informasi identitas bayi atau balita.</p>
        </div>
    </div>

    <div class="mt-6 space-y-5">
        <div>
            <x-input label="Nama Lengkap" name="child_nama" placeholder="Masukkan nama lengkap bayi / balita" x-model="form.child_nama" />
            <p x-show="errors.child_nama" x-cloak x-text="errors.child_nama" class="mt-1 text-xs font-semibold text-red-600"></p>
        </div>

        <div>
            <span class="ut-label">Jenis Kelamin</span>
            <div class="grid grid-cols-2 gap-3">
                <button type="button" x-on:click="form.child_jenis_kelamin = 'laki-laki'; delete errors.child_jenis_kelamin" class="rounded-2xl border p-4 text-center text-sm font-semibold transition" :class="form.child_jenis_kelamin === 'laki-laki' ? 'border-blue-400 bg-blue-50 text-blue-700' : 'border-gray-200 bg-white text-gray-500'">
                    <span class="mx-auto mb-2 grid h-10 w-10 place-items-center rounded-full" :class="form.child_jenis_kelamin === 'laki-laki' ? 'bg-blue-100' : 'bg-gray-100'">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="14" r="6"/><path d="M14.5 9.5 20 4"/><path d="M16 4h4v4"/></svg>
                    </span>
                    Laki-laki
                </button>
                <button type="button" x-on:click="form.child_jenis_kelamin = 'perempuan'; delete errors.child_jenis_kelamin" class="rounded-2xl border p-4 text-center text-sm font-semibold transition" :class="form.child_jenis_kelamin === 'perempuan' ? 'border-pink-400 bg-pink-50 text-pink-700' : 'border-gray-200 bg-white text-gray-500'">
                    <span class="mx-auto mb-2 grid h-10 w-10 place-items-center rounded-full" :class="form.child_jenis_kelamin === 'perempuan' ? 'bg-pink-100' : 'bg-gray-100'">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="9" r="5"/><path d="M12 14v7"/><path d="M9 18h6"/></svg>
                    </span>
                    Perempuan
                </button>
            </div>
            <input type="hidden" name="child_jenis_kelamin" x-model="form.child_jenis_kelamin">
            <p x-show="errors.child_jenis_kelamin" x-cloak x-text="errors.child_jenis_kelamin" class="mt-1 text-xs font-semibold text-red-600"></p>
            @error('child_jenis_kelamin') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-input label="Tanggal Lahir" name="child_tanggal_lahir" type="date" max="{{ now()->toDateString() }}" x-model="form.child_tanggal_lahir" />
            <p x-show="errors.child_tanggal_lahir" x-cloak x-text="errors.child_tanggal_lahir" class="mt-1 text-xs font-semibold text-red-600"></p>
        </div>
    </div>
</x-form-card>
