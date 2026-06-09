<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Pelaporan Mandiri United Tractors' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#151515] font-sans antialiased">
    <main class="min-h-screen lg:flex lg:items-start lg:justify-center lg:py-8">
        <div class="min-h-screen w-full bg-[#FAFAF8] shadow-2xl lg:min-h-[calc(100vh-4rem)] lg:max-w-[430px] lg:overflow-hidden lg:rounded-[2rem]">
            <div class="sticky top-0 z-30 border-b border-gray-100 bg-white/95 px-4 pb-3.5 pt-4 backdrop-blur">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0 flex-1 flex items-center">
                        <x-application-logo class="h-7 w-auto max-w-[200px] object-contain" />
                    </div>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                            @csrf
                            <button type="submit" class="rounded-full border border-gray-200 px-2.5 py-1.5 text-xs font-semibold text-gray-600 transition hover:border-[#FFD900] hover:text-[#111111]">
                                Keluar
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            {{ $slot }}
        </div>
    </main>
</body>
</html>
