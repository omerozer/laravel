<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        @keyframes spin-gradient {
            to { transform: rotate(360deg); }
        }
        .hero-avatar-wrapper {
            position: relative;
            display: inline-flex;
            width: 7rem;
            height: 7rem;
        }
        @media (min-width: 640px) {
            .hero-avatar-wrapper { width: 9rem; height: 9rem; }
        }
        @media (min-width: 1024px) {
            .hero-avatar-wrapper { width: 11rem; height: 11rem; }
        }
        .hero-avatar-wrapper::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #a855f7, #7c3aed, #6366f1, #a855f7);
            animation: spin-gradient 8s linear infinite;
        }
        .hero-avatar-ring-inner {
            position: relative;
            z-index: 1;
            border-radius: 50%;
            overflow: hidden;
            width: 100%;
            height: 100%;
            background: rgb(249 250 251);
        }
        .dark .hero-avatar-ring-inner {
            background: #0f0a1e;
        }
        .hero-avatar-img {
            filter: grayscale(100%);
            transition: filter 0.4s ease;
        }
        .hero-avatar-group:hover .hero-avatar-img {
            filter: grayscale(0);
        }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-[linear-gradient(135deg,#1e1b4b_0%,#0f0a1e_35%,#020617_70%,#1e1b4b_100%)] dark:bg-fixed font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 pt-20 pb-24 sm:pt-32 sm:pb-32 lg:pt-40 lg:pb-40 relative">
                    <div class="text-center w-full">
                        <div class="hero-avatar-group hero-avatar-wrapper mb-8 mx-auto inline-flex opacity-0 animate-fade-in-up">
                            <div class="hero-avatar-ring-inner flex items-center justify-center shrink-0">
                                <img
                                    src="{{ asset('images/omer.jpeg') }}"
                                    alt="Ömer"
                                    class="hero-avatar-img w-full h-full rounded-full object-cover"
                                    loading="eager"
                                >
                            </div>
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight opacity-0 animate-fade-in-up animate-delay-100">
                            <span class="block">
                                <span class="lang-h1a dark:hidden bg-gradient-to-r from-[#a855f7] to-black bg-clip-text text-transparent" data-lang-en="Software That Runs Your" data-lang-tr="İşlerinizi Yöneten">Software That Runs Your</span>
                                <span class="lang-h1a hidden dark:block text-white" data-lang-en="Software That Runs Your" data-lang-tr="İşlerinizi Yöneten">Software That Runs Your</span>
                            </span>
                            <span class="block mt-1">
                                <span class="lang-h1b dark:hidden bg-gradient-to-r from-[#a855f7] to-black bg-clip-text text-transparent" data-lang-en="Operations" data-lang-tr="Özel Yazılımlar">Operations</span>
                                <span class="lang-h1b hidden dark:block text-[#a855f7]" data-lang-en="Operations" data-lang-tr="Özel Yazılımlar">Operations</span>
                            </span>
                        </h1>
                        <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-zinc-400 max-w-2xl mx-auto lang-subtitle opacity-0 animate-fade-in-up animate-delay-200" data-lang-en="I build internal systems that automate daily work and keep your operations running without constant supervision." data-lang-tr="İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.">I build internal systems that automate daily work and keep your operations running without constant supervision.</p>
                        <div class="mt-8 flex flex-row items-center justify-center gap-4 opacity-0 animate-fade-in-up animate-delay-200">
                            <button type="button" id="contact-open" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 dark:border-zinc-600 px-6 py-3 text-base font-semibold text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-[#a855f7]/50 focus:ring-offset-2 dark:focus:ring-offset-transparent">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                <span class="lang-contact" data-lang-en="Contact" data-lang-tr="İletişim">Contact</span>
                            </button>
                            <a href="{{ $userPanelLinkedIn ?? 'https://www.linkedin.com/in/omerdesign/' }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0A66C2] px-6 py-3 text-base font-semibold text-white hover:bg-[#004182] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0A66C2]/50 focus:ring-offset-2 focus:ring-offset-black dark:focus:ring-offset-white" aria-label="LinkedIn">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                        <div class="mt-10 flex justify-center opacity-0 animate-fade-in-up animate-delay-300">
                            <img
                                src="{{ asset('images/tech.png') }}"
                                alt="CRM solutions overview"
                                class="w-full max-w-3xl rounded-3xl shadow-2xl"
                                loading="lazy"
                            >
                        </div>
                    </div>
                </div>
            </section>

            {{-- Feature cards (Next.js style) --}}
            <section class="border-t border-gray-200 dark:border-white/5">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-none opacity-0 animate-fade-in-up animate-delay-200">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white lang-card1-title" data-lang-en="When Orders Start Falling Through the Cracks" data-lang-tr="Siparişler Karışıyorsa">When Orders Start Falling Through the Cracks</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400 lang-card1-desc" data-lang-en="Orders from forms, email, or WhatsApp are captured automatically and tracked in one place. Every request is recorded — no manual entry and no missed orders." data-lang-tr="Farklı kanallardan gelen siparişlerin kaybolmasını ve yanlış işlenmesini önleyen tek akış kurulur. Her kayıt otomatik oluşur, kimse birbirine sormak zorunda kalmaz.">Orders from forms, email, or WhatsApp are captured automatically and tracked in one place. Every request is recorded — no manual entry and no missed orders.</p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-none opacity-0 animate-fade-in-up animate-delay-300">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white lang-card2-title" data-lang-en="When Customer Information Is Scattered" data-lang-tr="Müşteri Bilgileri Dağınıksa">When Customer Information Is Scattered</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400 lang-card2-desc" data-lang-en="Customer records from phone, WhatsApp, and spreadsheets are centralized in one system. Conversations and quotes are always available to your team." data-lang-tr="Telefon, WhatsApp ve Excel arasında dolaşan müşteri kayıtları tek yerde toplanır. Geçmiş görüşmeler ve teklifler her zaman ulaşılabilir olur.">Customer records from phone, WhatsApp, and spreadsheets are centralized in one system. Conversations and quotes are always available to your team.</p>
                        </div>
                        <div class="group rounded-2xl border border-gray-200 dark:border-white/5 bg-white dark:bg-white/[0.02] p-6 lg:p-8 hover:border-[#a855f7]/40 hover:-translate-y-1 transition-all duration-300 shadow-sm dark:shadow-none opacity-0 animate-fade-in-up animate-delay-400">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#a855f7]/10 text-[#a855f7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white lang-card3-title" data-lang-en="If You Have to Constantly Check the Business" data-lang-tr="Sürekli Kontrol Etmek Zorundaysanız">If You Have to Constantly Check the Business</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-zinc-400 lang-card3-desc" data-lang-en="The system sends reminders, updates statuses, and generates reports automatically — even when you are not actively checking it." data-lang-tr="İşlerin ilerlemesi kişilerden bağımsız hale gelir. Siz takip etmeseniz bile sistem hatırlatır, ilerletir ve raporlar.">The system sends reminders, updates statuses, and generates reports automatically — even when you are not actively checking it.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>

    @php $contactModalOpen = session('contact_success') || session('contact_error') || $errors->any(); @endphp
    {{-- Contact modal --}}
    <div id="contact-modal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 p-4 {{ $contactModalOpen ? 'flex' : 'hidden' }}" aria-hidden="{{ $contactModalOpen ? 'false' : 'true' }}">
        <div id="contact-modal-panel" class="relative w-full max-w-md rounded-2xl bg-white dark:bg-zinc-900 shadow-xl p-6 transition-all duration-200 {{ $contactModalOpen ? 'opacity-100 scale-100' : 'opacity-0 scale-95' }}">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white lang-modal-title" data-lang-en="Contact" data-lang-tr="İletişim">Contact</h2>
                <button type="button" id="contact-close" class="p-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors" aria-label="Close">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            @if(session('contact_success'))
                <p class="mb-4 text-sm text-green-600 dark:text-green-400">Message sent successfully.</p>
            @endif
            @if(session('contact_error'))
                <p class="mb-4 text-sm text-red-600 dark:text-red-400">{{ session('contact_error') }}</p>
            @endif
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="contact-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 lang-modal-name" data-lang-en="Name" data-lang-tr="Ad">Name</label>
                    <input type="text" id="contact-name" name="name" required
                        class="w-full rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 px-4 py-2 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#a855f7]/50 focus:border-[#a855f7]"
                        value="{{ old('name') }}">
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="contact-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" id="contact-email" name="email" required
                        class="w-full rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 px-4 py-2 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#a855f7]/50 focus:border-[#a855f7]"
                        value="{{ old('email') }}">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="contact-message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 lang-modal-message" data-lang-en="Message" data-lang-tr="Mesaj">Message</label>
                    <textarea id="contact-message" name="message" rows="4" required
                        class="w-full rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 px-4 py-2 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#a855f7]/50 focus:border-[#a855f7]">{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full rounded-lg bg-[#a855f7] px-4 py-3 text-base font-semibold text-white hover:bg-[#9333ea] transition-colors focus:outline-none focus:ring-2 focus:ring-[#a855f7]/50 lang-modal-send" data-lang-en="Send" data-lang-tr="Gönder">Send</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button, a').forEach(function (el) { el.style.cursor = 'pointer'; });

            var lang = localStorage.getItem('lang') || 'en';
            var langEn = document.getElementById('lang-en');
            var langTr = document.getElementById('lang-tr');

            function applyLang(l) {
                lang = l;
                localStorage.setItem('lang', lang);
                document.querySelectorAll('[data-lang-en][data-lang-tr]').forEach(function (el) {
                    el.textContent = el.getAttribute('data-lang-' + lang);
                });
                if (langEn) {
                    langEn.setAttribute('aria-current', l === 'en' ? 'page' : 'false');
                    langEn.classList.toggle('opacity-50', l !== 'en');
                    langEn.classList.toggle('opacity-100', l === 'en');
                }
                if (langTr) {
                    langTr.setAttribute('aria-current', l === 'tr' ? 'page' : 'false');
                    langTr.classList.toggle('opacity-50', l !== 'tr');
                    langTr.classList.toggle('opacity-100', l === 'tr');
                }
            }

            if (langEn) langEn.addEventListener('click', function () { applyLang('en'); });
            if (langTr) langTr.addEventListener('click', function () { applyLang('tr'); });

            applyLang(lang);

            var contactModal = document.getElementById('contact-modal');
            var contactOpen = document.getElementById('contact-open');
            var contactClose = document.getElementById('contact-close');
            var contactPanel = document.getElementById('contact-modal-panel');

            function openContactModal() {
                contactModal.classList.remove('hidden');
                contactModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(function () {
                    contactPanel.classList.remove('opacity-0', 'scale-95');
                    contactPanel.classList.add('opacity-100', 'scale-100');
                });
            }

            function closeContactModal() {
                contactPanel.classList.add('opacity-0', 'scale-95');
                contactPanel.classList.remove('opacity-100', 'scale-100');
                setTimeout(function () {
                    contactModal.classList.add('hidden');
                    contactModal.classList.remove('flex');
                    document.body.style.overflow = '';
                }, 200);
            }

            if (contactOpen) contactOpen.addEventListener('click', openContactModal);
            if (contactClose) contactClose.addEventListener('click', closeContactModal);
            if (contactModal) contactModal.addEventListener('click', function (e) { if (e.target === contactModal) closeContactModal(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && contactModal && !contactModal.classList.contains('hidden')) closeContactModal(); });
        });
    </script>
</body>
</html>
