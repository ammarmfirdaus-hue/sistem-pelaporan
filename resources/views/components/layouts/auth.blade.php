<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Pelaporan Mandiri United Tractors' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FAFAF8] font-sans antialiased">
    <main class="min-h-screen w-full">
        <div class="grid min-h-screen w-full bg-white lg:grid-cols-[0.96fr_1.04fr]">
            <aside class="relative hidden min-h-screen overflow-hidden bg-[#FFD900] lg:block">
                <img
                    src="{{ asset('images/auth-hero-ut.png') }}"
                    alt="Ibu dan anak"
                    class="absolute inset-0 h-full w-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-br from-[#FFD900]/5 via-transparent to-[#111111]/5"></div>

                <!-- Decorative Elements (Desktop Only) -->
                <div class="absolute inset-0 pointer-events-none select-none z-0">
                    <!-- Soft white glow behind logo/text -->
                    <div class="absolute -left-20 top-[15%] h-[350px] w-[350px] rounded-full bg-white/15 blur-[90px]"></div>
                    <!-- Soft yellow highlight glow -->
                    <div class="absolute -right-10 bottom-[10%] h-[300px] w-[300px] rounded-full bg-[#FFD900]/20 blur-[80px]"></div>
                    
                    <!-- Curved orbital shapes in top-left -->
                    <svg class="absolute -left-32 -top-32 w-[500px] h-[500px] text-white/15" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="0.3">
                        <circle cx="50" cy="50" r="48" stroke-dasharray="1 2" />
                        <circle cx="50" cy="50" r="40" />
                        <circle cx="50" cy="50" r="32" stroke-dasharray="2 1" />
                    </svg>

                    <!-- Fine dot matrix pattern on the left empty space -->
                    <svg class="absolute left-8 top-[35%] w-[80px] h-[160px] text-white/10" fill="currentColor">
                        <pattern id="dot-pattern-comp" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1.5" />
                        </pattern>
                        <rect width="80" height="160" fill="url(#dot-pattern-comp)" />
                    </svg>
                </div>

                <div class="relative z-10 flex min-h-screen flex-col p-10 xl:p-12">
                    <div class="inline-flex items-center">
                        <x-application-logo class="h-14 w-auto max-w-[280px] object-contain drop-shadow-sm" />
                    </div>
                    <div class="mt-[14vh] max-w-md rounded-[1.75rem] bg-white/62 p-7 shadow-[0_18px_45px_rgba(17,17,17,0.10)] backdrop-blur-sm">
                        <h1 class="text-4xl font-bold leading-tight text-[#111111]">Data lebih rapi,<br>layanan lebih peduli.</h1>
                        <p class="mt-4 text-base font-medium leading-7 text-[#1A1A1A]/80">Bersama mencatat, memantau, dan mendukung tumbuh kembang anak.</p>
                    </div>
                    <div class="mb-4 mt-auto grid grid-cols-3 gap-4 rounded-[24px] bg-white/70 p-4 shadow-sm backdrop-blur-sm">
                        <div class="rounded-2xl bg-white/55 p-3.5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#FFD900] text-[#111111]">
                                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19V5"/><path d="M9 19v-8"/><path d="M14 19v-5"/><path d="M19 19V8"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold text-[#111111]">Data Rapi</p>
                            <p class="mt-1 text-[11px] font-medium leading-4 text-gray-600">Laporan tersimpan lebih terstruktur</p>
                        </div>
                        <div class="rounded-2xl bg-white/55 p-3.5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#FFD900] text-[#111111]">
                                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold text-[#111111]">Aman</p>
                            <p class="mt-1 text-[11px] font-medium leading-4 text-gray-600">Akses data hanya untuk petugas terkait</p>
                        </div>
                        <div class="rounded-2xl bg-white/55 p-3.5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#FFD900] text-[#111111]">
                                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold text-[#111111]">Cepat</p>
                            <p class="mt-1 text-[11px] font-medium leading-4 text-gray-600">Input laporan langsung dari perangkat mobile</p>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="flex min-h-screen items-center justify-center bg-[#FAFAF8] px-5 py-8 sm:px-8 lg:bg-white lg:px-12 xl:px-16">
                <div class="w-full max-w-[520px]">
                    {{ $slot }}
                </div>
            </section>
        </div>
    </main>
</body>
</html>
