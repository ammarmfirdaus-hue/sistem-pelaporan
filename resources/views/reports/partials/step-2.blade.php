<div class="space-y-5">
    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M6 21v-2a6 6 0 0 1 12 0v2"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Identitas Ayah</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Lengkapi informasi ayah.</p>
            </div>
        </div>
        <div class="mt-5 space-y-4">
            <div>
                <x-input label="Nama Lengkap Ayah" name="ayah_nama" placeholder="Masukkan nama lengkap ayah" x-model="form.ayah_nama" />
                <p x-show="errors.ayah_nama" x-cloak x-text="errors.ayah_nama" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
            <div>
                <label class="ut-label" for="ayah_alamat">Alamat Ayah</label>
                <textarea id="ayah_alamat" name="ayah_alamat" class="ut-input min-h-24" placeholder="Masukkan alamat domisili lengkap" x-model="form.ayah_alamat">{{ old('ayah_alamat') }}</textarea>
                <p x-show="errors.ayah_alamat" x-cloak x-text="errors.ayah_alamat" class="mt-1 text-xs font-semibold text-red-600"></p>
                @error('ayah_alamat') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-input label="No HP Ayah" name="ayah_no_hp" placeholder="Contoh: 081234567890" x-model="form.ayah_no_hp" />
                <p x-show="errors.ayah_no_hp" x-cloak x-text="errors.ayah_no_hp" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
        </div>
    </x-form-card>

    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M6 21v-2a6 6 0 0 1 12 0v2"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Identitas Ibu</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Lengkapi informasi ibu.</p>
            </div>
        </div>
        <div class="mt-5 space-y-4">
            <div>
                <x-input label="Nama Lengkap Ibu" name="ibu_nama" placeholder="Masukkan nama lengkap ibu" x-model="form.ibu_nama" />
                <p x-show="errors.ibu_nama" x-cloak x-text="errors.ibu_nama" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
            <div>
                <label class="ut-label" for="ibu_alamat">Alamat Ibu</label>
                <textarea id="ibu_alamat" name="ibu_alamat" class="ut-input min-h-24" placeholder="Masukkan alamat domisili lengkap" x-model="form.ibu_alamat">{{ old('ibu_alamat') }}</textarea>
                <p x-show="errors.ibu_alamat" x-cloak x-text="errors.ibu_alamat" class="mt-1 text-xs font-semibold text-red-600"></p>
                @error('ibu_alamat') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-input label="No HP Ibu" name="ibu_no_hp" placeholder="Contoh: 081234567890" x-model="form.ibu_no_hp" />
                <p x-show="errors.ibu_no_hp" x-cloak x-text="errors.ibu_no_hp" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
        </div>
    </x-form-card>
</div>
