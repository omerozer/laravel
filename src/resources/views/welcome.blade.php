<!DOCTYPE html>
<html lang="tr" class="h-full dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fonts/filament/filament/inter/index.css') }}">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-black font-sans antialiased text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(0,255,153,0.18),transparent)]" aria-hidden="true"></div>
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 pt-20 pb-24 sm:pt-32 sm:pb-32 lg:pt-40 lg:pb-40 relative">
                    <div class="text-center max-w-4xl mx-auto">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white">
                            Laravel ile
                            <span class="block mt-2 bg-gradient-to-r from-accent-400 via-accent-500 to-emerald-400 bg-clip-text text-transparent">
                                Web Uygulamaları
                            </span>
                        </h1>
                        <p class="mt-6 text-lg sm:text-xl text-zinc-400 max-w-2xl mx-auto">
                            Modern, hızlı ve güvenilir web uygulamaları oluşturmak için Laravel framework ile başlayın.
                        </p>
                        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center rounded-lg bg-accent-500 px-6 py-3 text-base font-semibold text-black hover:bg-accent-400 transition-colors focus:outline-none focus:ring-2 focus:ring-accent-500/50 focus:ring-offset-2 focus:ring-offset-black">
                                Bloğu Keşfet
                            </a>
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-600 px-6 py-3 text-base font-semibold text-white hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-black">
                                Admin
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Feature cards (Next.js style) --}}
            <section class="border-t border-white/5">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        <div class="group rounded-2xl border border-white/5 bg-white/[0.02] p-6 lg:p-8 hover:border-accent-500/30 transition-colors">
                            <h3 class="text-lg font-semibold text-white">Modern Stack</h3>
                            <p class="mt-2 text-sm text-zinc-400">
                                Laravel, Tailwind CSS ve Vite ile güncel teknoloji stack'i.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-white/5 bg-white/[0.02] p-6 lg:p-8 hover:border-accent-500/30 transition-colors">
                            <h3 class="text-lg font-semibold text-white">Filament Admin</h3>
                            <p class="mt-2 text-sm text-zinc-400">
                                Güçlü Filament panel ile hızlı ve esnek yönetim arayüzü.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-white/5 bg-white/[0.02] p-6 lg:p-8 hover:border-accent-500/30 transition-colors">
                            <h3 class="text-lg font-semibold text-white">Blog & İçerik</h3>
                            <p class="mt-2 text-sm text-zinc-400">
                                Medium tarzı blog yazıları ile içerik yayınlama.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button, a').forEach(function (el) { el.style.cursor = 'pointer'; });
        });
    </script>
</body>
</html>
