<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard Admin' }} - Sistem Pelaporan Mandiri United Tractors</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F5F5F3] font-sans text-[#111111] antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        <aside class="hidden border-r border-black/5 bg-white lg:flex lg:min-h-screen lg:flex-col">
            <div class="border-b border-black/5 px-7 py-6">
                <x-application-logo class="h-16 w-auto max-w-[210px] object-contain" />
                <p class="mt-4 text-xs font-semibold uppercase tracking-[0.18em] text-[#8A6500]">Admin Area</p>
            </div>

            <nav class="flex-1 space-y-2 px-4 py-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-[#FFD900] px-4 py-3 text-sm font-semibold text-[#111111] shadow-sm">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-white/75">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 13h8V3H3z"/><path d="M13 21h8V11h-8z"/><path d="M13 3h8v6h-8z"/><path d="M3 21h8v-6H3z"/></svg>
                    </span>
                    Dashboard
                </a>

                @foreach (['Posyandu', 'Petugas', 'Laporan', 'Monitoring'] as $item)
                    <a href="#" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-gray-500 transition hover:bg-[#FAFAF8] hover:text-[#111111]">
                        <span class="grid h-9 w-9 place-items-center rounded-xl bg-[#FAFAF8] text-[#8A6500]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h10"/></svg>
                        </span>
                        {{ $item }}
                    </a>
                @endforeach
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="border-t border-black/5 p-4">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-600 transition hover:border-[#FFD900] hover:text-[#111111]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                    Keluar
                </button>
            </form>
        </aside>

        <div class="min-w-0">
            <header class="sticky top-0 z-20 border-b border-black/5 bg-white/90 px-5 py-4 backdrop-blur lg:px-8">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#8A6500]">United Tractors</p>
                        <h1 class="mt-1 truncate text-xl font-bold text-[#111111] lg:text-2xl">{{ $title ?? 'Dashboard Admin' }}</h1>
                    </div>
                    <div class="flex shrink-0 items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-[#111111]">{{ auth()->user()?->name }}</p>
                            <span class="inline-flex rounded-full bg-[#FFD900]/25 px-3 py-1 text-xs font-semibold text-[#7A5A00]">Admin</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                            @csrf
                            <button type="submit" class="rounded-full border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-600">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="min-h-[calc(100vh-73px)] px-5 py-6 lg:px-8 lg:py-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
