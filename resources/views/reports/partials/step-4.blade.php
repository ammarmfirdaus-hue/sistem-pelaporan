<div class="space-y-5">
    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M3 6h.01"/><path d="M3 12h.01"/><path d="M3 18h.01"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Ringkasan Data</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Ringkasan informasi bayi yang dilaporkan.</p>
            </div>
        </div>
        <dl class="mt-5 grid gap-3 rounded-2xl bg-[#FAFAF8] p-4 text-sm">
            <div class="grid grid-cols-[120px_1fr] gap-3"><dt class="text-gray-500">Nama Bayi</dt><dd class="font-semibold" x-text="form.child_nama || '-'"></dd></div>
            <div class="grid grid-cols-[120px_1fr] gap-3"><dt class="text-gray-500">Nama Ibu</dt><dd class="font-semibold" x-text="form.ibu_nama || '-'"></dd></div>
            <div class="grid grid-cols-[120px_1fr] gap-3"><dt class="text-gray-500">Umur Bayi</dt><dd class="font-bold" x-text="ageText()"></dd></div>
        </dl>
    </x-form-card>

    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19V5"/><path d="M4 19h16"/><path d="M9 15v-5"/><path d="M14 15V8"/><path d="M19 15v-3"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Hasil Pengukuran</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Masukkan hasil pengukuran bayi.</p>
            </div>
        </div>
        <div class="mt-5 space-y-4">
            <div>
                <x-input label="Berat Badan (kg)" name="berat_badan" type="number" step="0.01" placeholder="0.0" x-model="form.berat_badan" />
                <p x-show="errors.berat_badan" x-cloak x-text="errors.berat_badan" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
            <div>
                <x-input label="Tinggi Badan (cm)" name="tinggi_badan" type="number" step="0.01" placeholder="0.0" x-model="form.tinggi_badan" />
                <p x-show="errors.tinggi_badan" x-cloak x-text="errors.tinggi_badan" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
            <div>
                <x-input label="Lingkar Kepala (cm)" name="lingkar_kepala" type="number" step="0.01" placeholder="0.0" x-model="form.lingkar_kepala" />
                <p x-show="errors.lingkar_kepala" x-cloak x-text="errors.lingkar_kepala" class="mt-1 text-xs font-semibold text-red-600"></p>
            </div>
        </div>
    </x-form-card>

    <x-form-card>
        <div class="flex items-start gap-4">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14"/><path d="M5 12h14"/><rect x="3" y="7" width="18" height="14" rx="2"/></svg>
            </span>
            <div>
                <h2 class="text-xl font-bold leading-snug">Tindakan Tambahan</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Catat imunisasi dan tindakan tambahan yang diberikan.</p>
            </div>
        </div>
        <div class="mt-5 space-y-4">
            <x-select label="Imunisasi" name="imunisasi">
                <option value="">Pilih jenis imunisasi</option>
                @foreach (['BCG', 'DPT-HB-Hib', 'Polio', 'Campak Rubella', 'PCV', 'Rotavirus'] as $item)
                    <option value="{{ $item }}" @selected(old('imunisasi') === $item)>{{ $item }}</option>
                @endforeach
            </x-select>

            <label class="flex items-start gap-3 rounded-2xl bg-[#FAFAF8] p-4">
                <input type="checkbox" name="beri_vitamin_a" value="1" @checked(old('beri_vitamin_a')) class="mt-1 h-6 w-6 rounded border-gray-300 text-[#FFD900] focus:ring-[#FFD900]">
                <span>
                    <span class="block text-sm font-semibold">Beri Kapsul Vitamin A</span>
                    <span class="text-xs font-medium text-gray-500">Diberikan setiap Februari dan Agustus</span>
                </span>
            </label>

            <label class="flex items-start gap-3 rounded-2xl bg-[#FAFAF8] p-4">
                <input type="checkbox" name="beri_obat_cacing" value="1" @checked(old('beri_obat_cacing')) class="mt-1 h-6 w-6 rounded border-gray-300 text-[#FFD900] focus:ring-[#FFD900]">
                <span>
                    <span class="block text-sm font-semibold">Beri Obat Cacing</span>
                    <span class="text-xs font-medium text-gray-500">Diberikan untuk anak usia di atas 12 bulan</span>
                </span>
            </label>
        </div>
    </x-form-card>
</div>
