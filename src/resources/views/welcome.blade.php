<!DOCTYPE html>
<html lang="tr" class="h-full">
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
<body class="h-full bg-gray-50 dark:bg-black font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(4,193,106,0.18),transparent)]" aria-hidden="true"></div>
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 pt-20 pb-24 sm:pt-32 sm:pb-32 lg:pt-40 lg:pb-40 relative">
                    <div class="text-center max-w-4xl mx-auto">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight">
                            <span class="block">
                                <span class="dark:hidden bg-gradient-to-r from-[#04c16a] to-black bg-clip-text text-transparent">İşinizi Yöneten Özel Yazılımlar</span>
                                <span class="hidden dark:block">
                                    <span class="text-white">İşinizi Yöneten </span>
                                    <span class="text-[#04c16a]">Özel Yazılımlar</span>
                                </span>
                            </span>
                        </h1>
                        <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-zinc-400 max-w-2xl mx-auto">
                            İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.
                        </p>
                        <div class="mt-10 flex justify-center">
                            <img
                                src="{{ asset('images/crm-cozumleri.png') }}"
                                alt="CRM çözümlerinin alanlarını gösteren görsel"
                                class="w-full max-w-3xl rounded-2xl shadow-lg ring-1 ring-black/5 dark:ring-white/10"
                                loading="lazy"
                            >
                        </div>
                        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="https://www.linkedin.com/in/omerdesign/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#04c16a] px-6 py-3 text-base font-semibold text-white hover:bg-[#03a858] transition-colors focus:outline-none focus:ring-2 focus:ring-[#04c16a]/50 focus:ring-offset-2 focus:ring-offset-black dark:focus:ring-offset-white" aria-label="LinkedIn">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </a>
                            <span class="inline-flex items-center justify-center rounded-lg border border-gray-300 dark:border-zinc-600 px-6 py-3 text-base font-semibold text-gray-900 dark:text-white cursor-default opacity-90">
                                İletişim
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Feature cards (Next.js style) --}}
            <section class="border-t border-gray-200 dark:border-white/5">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#04c16a]/30 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#04c16a]/10 text-[#04c16a]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Siparişler Karışıyorsa</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                Farklı kanallardan gelen siparişlerin kaybolmasını ve yanlış işlenmesini önleyen tek akış kurulur. Her kayıt otomatik oluşur, kimse birbirine sormak zorunda kalmaz.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#04c16a]/30 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#04c16a]/10 text-[#04c16a]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Müşteri Bilgileri Dağınıksa</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                Telefon, WhatsApp ve Excel arasında dolaşan müşteri kayıtları tek yerde toplanır. Geçmiş görüşmeler ve teklifler her zaman ulaşılabilir olur.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#04c16a]/30 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#04c16a]/10 text-[#04c16a]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Sürekli Kontrol Etmek Zorundaysanız</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                İşlerin ilerlemesi kişilerden bağımsız hale gelir. Siz takip etmeseniz bile sistem hatırlatır, ilerletir ve raporlar.
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
