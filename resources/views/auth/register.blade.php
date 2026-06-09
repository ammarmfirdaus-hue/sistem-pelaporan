<x-layouts.auth title="Daftar - Sistem Pelaporan Mandiri">
    <div class="mb-8 flex justify-center lg:mb-10">
        <x-application-logo class="h-12 w-auto max-w-[240px] object-contain lg:h-14 lg:max-w-[280px]" />
    </div>

    <div class="text-center">
        <h1 class="text-3xl font-bold leading-tight text-[#111111] sm:text-4xl">Buat Akun Baru</h1>
        <p class="mx-auto mt-3 max-w-sm text-sm font-medium leading-6 text-gray-500">Buat akun anda untuk menggunakan sistem pelaporan.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5 rounded-[28px] border border-black/5 bg-white p-5 shadow-[0_14px_35px_rgba(17,17,17,0.06)] ring-1 ring-gray-100 sm:p-6 lg:p-8 lg:shadow-[0_24px_70px_rgba(0,0,0,0.07)] lg:ring-0">
        @csrf
        <div>
            <x-input label="Nama Lengkap" name="name" type="text" autocomplete="name" placeholder="Masukkan nama lengkap Anda" required autofocus />
        </div>

        <div>
            <x-input label="Email" name="email" type="email" autocomplete="email" placeholder="Masukkan email Anda" required />
        </div>

        <div>
            <x-input label="Password" name="password" type="password" autocomplete="new-password" placeholder="Masukkan password Anda" required />
        </div>

        <div>
            <x-input label="Konfirmasi Password" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ulangi password Anda" required />
        </div>

        <button type="submit" class="ut-button w-full py-4 text-base">Daftar</button>
    </form>

    <div class="mt-7 flex items-center gap-4 text-sm text-gray-400">
        <span class="h-px flex-1 bg-gray-200"></span>
        <span>atau</span>
        <span class="h-px flex-1 bg-gray-200"></span>
    </div>

    <p class="mt-6 text-center text-sm font-medium text-gray-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-[#D6A900] underline">Masuk</a>
    </p>
</x-layouts.auth>
