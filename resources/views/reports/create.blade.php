<x-layouts.app title="Form Input Laporan">
    <div class="space-y-5 px-4 pb-32 pt-5" x-data="reportForm({
        hasPosyandu: @js((bool) $user->posyandu_id),
        showConfirmPosyandu: false,
        showEditPosyandu: @js($errors->posyanduIdentity->any()),
        posyandu: {
            nama_posyandu: @js($user->posyandu?->nama_posyandu ?? ''),
            kecamatan: @js($user->posyandu?->kecamatan ?? ''),
            kelurahan: @js($user->posyandu?->kelurahan ?? ''),
            kode_internal: @js($user->posyandu?->kode_internal ?? '')
        },
        form: {
            nama_posyandu: @js(old('nama_posyandu', '')),
            kecamatan: @js(old('kecamatan', '')),
            kelurahan: @js(old('kelurahan', '')),
            no_hp_petugas: @js(old('no_hp_petugas', '')),
            ayah_nama: @js(old('ayah_nama', '')),
            ayah_alamat: @js(old('ayah_alamat', '')),
            ayah_no_hp: @js(old('ayah_no_hp', '')),
            ibu_nama: @js(old('ibu_nama', '')),
            ibu_alamat: @js(old('ibu_alamat', '')),
            ibu_no_hp: @js(old('ibu_no_hp', '')),
            child_nama: @js(old('child_nama', '')),
            child_jenis_kelamin: @js(old('child_jenis_kelamin', '')),
            child_tanggal_lahir: @js(old('child_tanggal_lahir', '')),
            berat_badan: @js(old('berat_badan', '')),
            tinggi_badan: @js(old('tinggi_badan', '')),
            lingkar_kepala: @js(old('lingkar_kepala', ''))
        }
    })">
        <nav class="grid grid-cols-2 rounded-3xl border border-gray-100 bg-white p-1 shadow-sm">
            <a href="{{ route('reports.create') }}" class="rounded-2xl border-b-4 border-[#FFD900] px-3 py-3 text-center text-sm font-semibold text-[#111111]">
                Form Input
            </a>
            <a href="{{ route('history.index') }}" class="rounded-2xl px-3 py-3 text-center text-sm font-semibold text-gray-500">
                Histori Data
            </a>
        </nav>

        <section class="ut-card">
            <div class="flex items-center gap-4">
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-[#FFF6CC] text-[#8A6500]">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5h6"/><path d="M9 3h6v4H9z"/><path d="M5 7h14v14H5z"/><path d="M9 12h6"/><path d="M9 16h4"/></svg>
                </span>
                <div class="min-w-0 flex-1">
                    <h2 class="text-xl font-bold leading-snug text-[#111111]">Sistem Pelaporan Mandiri</h2>
                    <p class="text-sm font-medium text-gray-500" x-text="`Progress Step ${step}/4`"></p>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-3">
                <div class="h-2 flex-1 rounded-full bg-gray-200">
                    <div class="h-2 rounded-full bg-[#FFD900] transition-all duration-300" :style="`width: ${step * 25}%`"></div>
                </div>
                <span class="text-xs font-semibold text-gray-500" x-text="`${step * 25}%`"></span>
            </div>
        </section>

        @if (session('posyandu_status'))
            <div class="rounded-3xl border border-green-100 bg-green-50 p-4 text-sm font-semibold text-green-700">
                {{ session('posyandu_status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-3xl border border-red-100 bg-red-50 p-4 text-sm font-semibold text-red-700">
                Ada data yang belum sesuai. Periksa kembali isian laporan sebelum menyimpan.
            </div>
        @endif

        <form method="POST" action="{{ route('reports.store') }}" x-on:submit.prevent="submit($event.target)">
            @csrf
            <div
                x-show="step === 1"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                @include('reports.partials.step-1', ['user' => $user])
            </div>
            <div
                x-show="step === 2"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                @include('reports.partials.step-2')
            </div>
            <div
                x-show="step === 3"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                @include('reports.partials.step-3')
            </div>
            <div
                x-show="step === 4"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                @include('reports.partials.step-4')
            </div>

            <div class="fixed bottom-0 left-1/2 z-40 w-full max-w-[430px] -translate-x-1/2 border-t border-gray-100 bg-[#FAFAF8]/95 px-4 pb-[calc(0.75rem+env(safe-area-inset-bottom))] pt-3 shadow-[0_-6px_20px_rgba(17,17,17,0.06)] backdrop-blur">
                <div class="flex gap-3">
                    <button type="button" x-on:click="prevStep()" :disabled="step === 1" class="ut-button-secondary min-h-12 flex-1 disabled:cursor-not-allowed disabled:opacity-40">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
                        Kembali
                    </button>
                    <button type="button" x-show="step < 4" x-cloak x-on:click="nextStep()" class="ut-button min-h-12 flex-1">
                        Selanjutnya
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                    <button type="submit" x-show="step === 4" x-cloak class="ut-button min-h-12 flex-1">
                        Simpan Data
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
                    </button>
                </div>
            </div>
        </form>

        @if ($user->posyandu)
            @include('reports.partials.edit-posyandu-modal', ['posyandu' => $user->posyandu])
        @endif
    </div>

    <script>
        function reportForm(initial) {
            return {
                step: 1,
                hasPosyandu: initial.hasPosyandu,
                showConfirmPosyandu: initial.showConfirmPosyandu,
                showEditPosyandu: initial.showEditPosyandu,
                posyandu: initial.posyandu,
                form: initial.form,
                errors: {},
                messages: {
                    nama_posyandu: 'Nama posyandu wajib diisi.',
                    kecamatan: 'Kecamatan wajib diisi.',
                    kelurahan: 'Kelurahan wajib diisi.',
                    no_hp_petugas: 'Nomor HP petugas wajib diisi.',
                    ayah_nama: 'Nama ayah wajib diisi.',
                    ayah_alamat: 'Alamat ayah wajib diisi.',
                    ayah_no_hp: 'Nomor HP ayah wajib diisi.',
                    ibu_nama: 'Nama ibu wajib diisi.',
                    ibu_alamat: 'Alamat ibu wajib diisi.',
                    ibu_no_hp: 'Nomor HP ibu wajib diisi.',
                    child_nama: 'Nama bayi/balita wajib diisi.',
                    child_jenis_kelamin: 'Jenis kelamin wajib dipilih.',
                    child_tanggal_lahir: 'Tanggal lahir wajib diisi.',
                    berat_badan: 'Berat badan wajib diisi.',
                    tinggi_badan: 'Tinggi badan wajib diisi.',
                    lingkar_kepala: 'Lingkar kepala wajib diisi.'
                },
                requiredFields() {
                    return {
                        1: this.hasPosyandu
                            ? ['no_hp_petugas']
                            : ['nama_posyandu', 'kecamatan', 'kelurahan', 'no_hp_petugas'],
                        2: ['ayah_nama', 'ayah_alamat', 'ayah_no_hp', 'ibu_nama', 'ibu_alamat', 'ibu_no_hp'],
                        3: ['child_nama', 'child_jenis_kelamin', 'child_tanggal_lahir'],
                        4: ['berat_badan', 'tinggi_badan', 'lingkar_kepala']
                    }[this.step] || [];
                },
                validateStep() {
                    this.errors = {};

                    this.requiredFields().forEach((field) => {
                        const value = this.form[field];

                        if (value === null || value === undefined || String(value).trim() === '') {
                            this.errors[field] = this.messages[field];
                        }
                    });

                    return Object.keys(this.errors).length === 0;
                },
                nextStep() {
                    if (!this.validateStep()) return;

                    this.step = Math.min(4, this.step + 1);
                    this.scrollTop();
                },
                prevStep() {
                    this.errors = {};
                    this.step = Math.max(1, this.step - 1);
                    this.scrollTop();
                },
                submit(formElement) {
                    if (!this.validateStep()) return;

                    formElement.submit();
                },
                scrollTop() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },
                ageText() {
                    if (!this.form.child_tanggal_lahir) return '-';
                    const birth = new Date(this.form.child_tanggal_lahir);
                    const now = new Date();
                    
                    birth.setHours(0,0,0,0);
                    now.setHours(0,0,0,0);

                    if (birth > now) {
                        return '0 Hari';
                    }

                    let temp = new Date(birth);
                    let months = 0;
                    while (true) {
                        let nextMonth = new Date(temp.getFullYear(), temp.getMonth() + 1, temp.getDate());
                        if (nextMonth.getMonth() !== (temp.getMonth() + 1) % 12) {
                            nextMonth = new Date(temp.getFullYear(), temp.getMonth() + 2, 0);
                        }
                        if (nextMonth > now) {
                            break;
                        }
                        temp = nextMonth;
                        months++;
                    }

                    const diffTime = Math.abs(now - temp);
                    const days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    if (months === 0) {
                        return `${days} Hari`;
                    }

                    if (days === 0) {
                        return `${months} Bulan`;
                    }

                    return `${months} Bulan ${days} Hari`;
                }
            }
        }
    </script>
</x-layouts.app>
