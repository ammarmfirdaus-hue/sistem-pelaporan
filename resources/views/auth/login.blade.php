<x-layouts.auth title="Masuk - Sistem Pelaporan Mandiri">
    <div class="mb-8 flex justify-center lg:mb-10">
        <x-application-logo class="h-12 w-auto max-w-[240px] object-contain lg:h-14 lg:max-w-[280px]" />
    </div>

    <div class="text-center">
        <h1 class="text-3xl font-bold leading-tight text-[#111111] sm:text-4xl">Selamat Datang</h1>
        <p class="mx-auto mt-3 max-w-sm text-sm font-medium leading-6 text-gray-500">Silakan masuk untuk melanjutkan pelaporan.</p>
    </div>

    @if (session('status'))
        <div class="mt-6 rounded-2xl bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5 rounded-[28px] border border-black/5 bg-white p-5 shadow-[0_14px_35px_rgba(17,17,17,0.06)] ring-1 ring-gray-100 sm:p-6 lg:p-8 lg:shadow-[0_24px_70px_rgba(0,0,0,0.07)] lg:ring-0">
        @csrf
        <div>
            <x-input label="Email" name="email" type="email" autocomplete="email" placeholder="Masukkan email anda" required autofocus />
        </div>

        <div>
            <x-input label="Password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password anda" required />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2 font-medium text-[#111111]">
                <input type="checkbox" name="remember" value="1" class="h-5 w-5 rounded border-gray-300 text-[#FFD900] focus:ring-[#FFD900]">
                Ingat saya
            </label>
            <a href="#" class="font-semibold text-[#111111] underline">Lupa password?</a>
        </div>

        <button type="submit" class="ut-button w-full py-4 text-base">Masuk</button>
    </form>

    <div class="mt-7 flex items-center gap-4 text-sm text-gray-400">
        <span class="h-px flex-1 bg-gray-200"></span>
        <span>atau</span>
        <span class="h-px flex-1 bg-gray-200"></span>
    </div>

    <p class="mt-6 text-center text-sm font-medium text-gray-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-[#D6A900] underline">Daftar</a>
    </p>
</x-layouts.auth>
