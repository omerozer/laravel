<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-[linear-gradient(135deg,#1e1b4b_0%,#0f0a1e_35%,#020617_70%,#1e1b4b_100%)] dark:bg-fixed font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 pt-20 pb-24 sm:pt-32 sm:pb-32 lg:pt-40 lg:pb-40 relative">
                    <div class="text-center max-w-4xl mx-auto">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight">
                            <span class="block">
                                <span class="dark:hidden bg-gradient-to-r from-[#a855f7] to-black bg-clip-text text-transparent">İşinizi Yöneten Özel Yazılımlar</span>
                                <span class="hidden dark:block">
                                    <span class="text-white">İşinizi Yöneten </span>
                                    <span class="text-[#a855f7]">Özel Yazılımlar</span>
                                </span>
                            </span>
                        </h1>
                        <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-zinc-400 max-w-2xl mx-auto">
                            İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.
                        </p>
                        <div class="mt-10 flex justify-center">
                            <img
                                src="{{ asset('images/tech.png') }}"
                                alt="CRM çözümlerinin alanlarını gösteren görsel"
                                class="w-full max-w-3xl rounded-3xl shadow-2xl"
                                loading="lazy"
                            >
                        </div>
                        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="https://www.linkedin.com/in/omerdesign/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#a855f7] px-6 py-3 text-base font-semibold text-white hover:bg-[#9333ea] transition-colors focus:outline-none focus:ring-2 focus:ring-[#a855f7]/50 focus:ring-offset-2 focus:ring-offset-black dark:focus:ring-offset-white" aria-label="LinkedIn">
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
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Siparişler Karışıyorsa</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                Farklı kanallardan gelen siparişlerin kaybolmasını ve yanlış işlenmesini önleyen tek akış kurulur. Her kayıt otomatik oluşur, kimse birbirine sormak zorunda kalmaz.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Müşteri Bilgileri Dağınıksa</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400">
                                Telefon, WhatsApp ve Excel arasında dolaşan müşteri kayıtları tek yerde toplanır. Geçmiş görüşmeler ve teklifler her zaman ulaşılabilir olur.
                            </p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 transition-colors shadow-sm dark:shadow-none">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
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

            {{-- Ön Muhasebe dashboard bölümü --}}
            <section class="border-t border-gray-200 dark:border-white/5 bg-white dark:bg-transparent">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="relative group">
                            <button
                                type="button"
                                class="block w-full focus:outline-none"
                                data-dashboard-lightbox-open
                                data-dashboard-lightbox-target="{{ asset('images/on-muhasebe-dashboard.png') }}"
                            >
                                <img
                                    src="{{ asset('images/on-muhasebe-dashboard.png') }}"
                                    alt="Ön Muhasebe programı dashboard tasarımı"
                                    class="w-full rounded-3xl shadow-2xl ring-1 ring-black/5 dark:ring-white/10 transition-transform group-hover:scale-[1.01]"
                                    loading="lazy"
                                >
                            </button>
                        </div>
                        <div class="space-y-4">
                            <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight">
                                Ön Muhasebe Programı Dashboard Tasarımı
                            </h2>
                            <p class="text-base sm:text-lg text-gray-600 dark:text-zinc-400">
                                Tek ekranda tahsilatlarınızı, faturalarınızı ve kasa hareketlerinizi görebileceğiniz, küçük ve orta ölçekli işletmeler için tasarlanmış bir ön muhasebe arayüzü.
                            </p>
                            <ul class="space-y-2 text-sm sm:text-base text-gray-600 dark:text-zinc-400">
                                <li>• Solda sade bir menü, sağda tam genişlikte finansal özet ve grafikler.</li>
                                <li>• Bugünkü tahsilat, bekleyen ödemeler ve kasa bakiyesi gibi KPI kartları.</li>
                                <li>• Aylık gelir/gider grafiği, son faturalar ve son cari hareketler tek bakışta.</li>
                            </ul>
                            <p class="text-sm text-gray-500 dark:text-zinc-500">
                                Görsele tıklayarak tasarımı detaylı şekilde inceleyebilirsiniz.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Koyu tema ön muhasebe dashboard bölümü --}}
            <section class="border-t border-gray-200 dark:border-white/5 bg-white dark:bg-transparent">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-4 text-white">
                            <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight">
                                Karanlık Tema Ön Muhasebe Dashboard
                            </h2>
                            <p class="text-base sm:text-lg text-zinc-300">
                                Gece modu seven ekipler için, mor ve siyah tonlarında hazırlanmış alternatif bir ön muhasebe ekranı. Göz yormadan kritik finansal göstergeleri takip etmenizi sağlar.
                            </p>
                            <ul class="space-y-2 text-sm sm:text-base text-zinc-300">
                                <li>• Solda şirket özeti ve günlük ciro, tahsilat, ödeme durumları.</li>
                                <li>• Ortada gelir / gider analizi grafiği ve net kâr kartları.</li>
                                <li>• Sağda bekleyen faturalar ve kritik uyarılar için özet paneller.</li>
                            </ul>
                        </div>
                        <div class="relative">
                            <button
                                type="button"
                                class="block w-full focus:outline-none"
                                data-dashboard-lightbox-open
                                data-dashboard-lightbox-target="{{ asset('images/on-muhasebe-dashboard-dark.png') }}"
                            >
                                <img
                                    src="{{ asset('images/on-muhasebe-dashboard-dark.png') }}"
                                    alt="Koyu tema ön muhasebe programı dashboard tasarımı"
                                    class="w-full rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,0.9)] ring-1 ring-purple-500/40"
                                    loading="lazy"
                                >
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        {{-- Dashboard lightbox --}}
        <div
            id="dashboard-lightbox"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-2 sm:px-4 lg:px-8"
        >
            <button
                type="button"
                class="absolute inset-0 w-full h-full cursor-zoom-out"
                data-dashboard-lightbox-close
                aria-label="Kapat"
            ></button>
            <div
                class="relative w-full max-w-6xl mx-auto transform transition-all duration-200 opacity-0 scale-95"
                data-dashboard-lightbox-panel
            >
                <button
                    type="button"
                    class="absolute -top-10 right-0 inline-flex items-center justify-center rounded-full bg-white/90 dark:bg-zinc-900/90 text-gray-700 dark:text-zinc-100 shadow-md px-3 py-1.5 text-xs font-medium hover:bg-white dark:hover:bg-zinc-900"
                    data-dashboard-lightbox-close
                >
                    Kapat
                </button>
                <img
                    src="{{ asset('images/on-muhasebe-dashboard.png') }}"
                    alt="Ön Muhasebe programı dashboard tasarımı - tam ekran"
                    class="w-full max-h-[80vh] rounded-3xl shadow-2xl bg-white object-contain"
                    data-dashboard-lightbox-image
                >
            </div>
        </div>

        <x-footer />
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button, a').forEach(function (el) { el.style.cursor = 'pointer'; });

            var lightbox = document.getElementById('dashboard-lightbox');
            if (lightbox) {
                var openButtons = document.querySelectorAll('[data-dashboard-lightbox-open]');
                var closeButtons = document.querySelectorAll('[data-dashboard-lightbox-close]');
                var panel = lightbox.querySelector('[data-dashboard-lightbox-panel]');
                var image = lightbox.querySelector('[data-dashboard-lightbox-image]');

                function openLightbox(event) {
                    var target = event.currentTarget;
                    if (image && target && target.getAttribute('data-dashboard-lightbox-target')) {
                        image.src = target.getAttribute('data-dashboard-lightbox-target');
                    }

                    lightbox.classList.remove('hidden');
                    lightbox.classList.add('flex');

                    if (panel) {
                        // Animasyonun düzgün çalışması için bir sonraki frame'de sınıfları değiştir
                        requestAnimationFrame(function () {
                            panel.classList.remove('opacity-0', 'scale-95');
                            panel.classList.add('opacity-100', 'scale-100');
                        });
                    }
                }

                function closeLightbox() {
                    if (panel) {
                        panel.classList.add('opacity-0', 'scale-95');
                        panel.classList.remove('opacity-100', 'scale-100');
                    }

                    // Animasyon süresiyle uyumlu kısa bir gecikmeden sonra tamamen gizle
                    setTimeout(function () {
                        lightbox.classList.add('hidden');
                        lightbox.classList.remove('flex');
                    }, 180);
                }

                openButtons.forEach(function (btn) {
                    btn.addEventListener('click', openLightbox);
                });

                closeButtons.forEach(function (btn) {
                    btn.addEventListener('click', closeLightbox);
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        closeLightbox();
                    }
                });
            }
        });
    </script>
</body>
</html>
