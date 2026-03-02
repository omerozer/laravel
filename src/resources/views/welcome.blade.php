<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($faviconPath ?? null)
        <link rel="icon" href="{{ asset($faviconPath) }}" @if($faviconSize ?? null) sizes="{{ $faviconSize }}x{{ $faviconSize }}" @endif>
    @endif
    <title>{{ $seoHomeTitle ?? config('app.name') }}</title>
    @if($seoHomeDescription ?? null)
        <meta name="description" content="{{ $seoHomeDescription }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
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
            filter: grayscale(0);
            transition: filter 0.4s ease;
        }
        .hero-avatar-group:hover .hero-avatar-img {
            filter: grayscale(100%);
        }
        @keyframes online-ring {
            0% { transform: scale(1); opacity: 0.6; }
            70% { transform: scale(2.2); opacity: 0; }
            100% { transform: scale(2.2); opacity: 0; }
        }
        .hero-online-dot {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 18px;
            height: 18px;
            background: #22c55e;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 1px rgba(34, 197, 94, 0.3);
            z-index: 10;
        }
        .hero-online-dot::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 2px solid rgba(34, 197, 94, 0.6);
            animation: online-ring 1.8s ease-out infinite;
        }
        .dark .hero-online-dot::before {
            border-color: rgba(34, 197, 94, 0.5);
        }
        @media (min-width: 640px) {
            .hero-online-dot { width: 20px; height: 20px; top: 12px; right: 12px; }
        }
        @media (min-width: 1024px) {
            .hero-online-dot { width: 22px; height: 22px; top: 14px; right: 14px; }
        }
        .exp-badge {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(124, 58, 237, 0.1));
            border: 1px solid rgba(168, 85, 247, 0.3);
        }
        .dark .exp-badge {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.2), rgba(124, 58, 237, 0.15));
            border-color: rgba(168, 85, 247, 0.4);
        }
        .exp-card {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .exp-card.exp-visible {
            opacity: 1;
            transform: translateY(0);
        }
        .tech-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: rgb(107 114 128);
            background: rgb(243 244 246);
            border: 1px solid rgb(229 231 235);
            border-radius: 9999px;
            transition: all 0.2s ease;
        }
        .tech-pill:hover {
            color: rgb(124 58 237);
            background: rgba(168, 85, 247, 0.08);
            border-color: rgba(168, 85, 247, 0.25);
        }
        .dark .tech-pill {
            color: rgb(161 161 170);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.08);
        }
        .dark .tech-pill:hover {
            color: rgb(196 181 253);
            background: rgba(168, 85, 247, 0.15);
            border-color: rgba(168, 85, 247, 0.3);
        }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-[linear-gradient(135deg,#1e1b4b_0%,#0f0a1e_35%,#020617_70%,#1e1b4b_100%)] dark:bg-fixed font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 pt-20 pb-12 sm:pt-32 sm:pb-16 lg:pt-40 lg:pb-20 relative">
                    <div class="text-center w-full">
                        <div class="hero-avatar-group hero-avatar-wrapper mb-8 mx-auto inline-flex opacity-0 animate-fade-in-up relative">
                            <div class="hero-avatar-ring-inner flex items-center justify-center shrink-0 relative">
                                <img
                                    src="{{ asset('images/omer.jpeg') }}"
                                    alt="Ömer"
                                    class="hero-avatar-img w-full h-full rounded-full object-cover"
                                    loading="eager"
                                >
                            </div>
                            <span class="hero-online-dot" aria-hidden="true" title="Online"></span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight opacity-0 animate-fade-in-up animate-delay-100">
                            <span class="block">
                                <span class="lang-h1a dark:hidden bg-gradient-to-r from-[#a855f7] to-black bg-clip-text text-transparent" data-lang-en="Software That Runs Your" data-lang-tr="İşlerinizi Yöneten">Software That Runs Your</span>
                                <span class="lang-h1a hidden dark:block text-white" data-lang-en="Software That Runs Your" data-lang-tr="İşlerinizi Yöneten">Software That Runs Your</span>
                            </span>
                            <span class="block mt-1">
                                <span class="lang-h1b dark:hidden bg-gradient-to-r from-[#a855f7] to-black bg-clip-text text-transparent" data-lang-en="Operations" data-lang-tr="Özel Yazılımlar">Operations</span>
                                <span class="lang-h1b hidden dark:block text-[#7c3aed]" data-lang-en="Operations" data-lang-tr="Özel Yazılımlar">Operations</span>
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

                        {{-- Teknolojiler --}}
                        <div class="mt-14 opacity-0 animate-fade-in-up animate-delay-300 max-w-xl mx-auto">
                            <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/[0.02] p-5 sm:p-6 hover:border-[#a855f7]/30 hover:shadow-lg hover:shadow-purple-500/5 transition-all duration-300">
                                <p class="text-sm font-bold tracking-widest text-gray-500 dark:text-zinc-400 mb-2 lang-tech-label" data-lang-en="TECHNOLOGIES" data-lang-tr="TEKNOLOJİLER">TEKNOLOJİLER</p>
                                <div class="flex justify-center mb-4">
                                    <div class="w-[1px] h-10 bg-gradient-to-b from-[#a855f7]/40 to-[#a855f7]/20 dark:from-[#a78bfa]/35 dark:to-[#a78bfa]/15"></div>
                                </div>
                                <div class="flex flex-wrap items-center justify-center gap-2">
                                    <span class="tech-pill">VueJS</span>
                                    <span class="tech-pill">Next.js</span>
                                    <span class="tech-pill">Laravel</span>
                                    <span class="tech-pill">NestJS</span>
                                    <span class="tech-pill">PostgreSQL</span>
                                    <span class="tech-pill">MySQL</span>
                                    <span class="tech-pill">SQLite</span>
                                    <span class="tech-pill">Figma</span>
                                    <span class="tech-pill">Auth</span>
                                    <span class="tech-pill">REST API</span>
                                    <span class="tech-pill">TypeScript</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Deneyimler - Timeline --}}
            <section id="deneyimler" class="border-t border-gray-200 dark:border-white/5">
                <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 mb-16">
                        <h2 class="text-3xl sm:text-4xl font-bold text-center text-gray-900 dark:text-white opacity-0 animate-fade-in-up" data-lang-en="Experience" data-lang-tr="Deneyimler">Deneyimler</h2>
                        <span class="exp-badge inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold text-[#7c3aed] dark:text-[#a78bfa] opacity-0 animate-fade-in-up" style="animation-delay: 80ms" data-lang-en="15+ years" data-lang-tr="15+ yıl">15+ yıl</span>
                    </div>
                    <div class="relative max-w-3xl mx-auto">
                        {{-- Vertical timeline line --}}
                        <div class="absolute left-4 sm:left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#a855f7] via-[#7c3aed] to-transparent dark:from-[#a855f7] dark:via-[#7c3aed] dark:to-transparent"></div>
                        <div class="space-y-0">
                            @foreach($experiences ?? [] as $index => $exp)
                            <div class="exp-card relative flex gap-6 sm:gap-8 pb-12 last:pb-0" data-exp-index="{{ $index }}" style="transition-delay: {{ $index * 80 }}ms">
                                {{-- Timeline node --}}
                                <div class="relative z-10 flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white dark:bg-zinc-800 border-2 border-[#a855f7] shadow-lg shadow-purple-500/20 flex items-center justify-center">
                                    <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#a855f7]"></div>
                                </div>
                                {{-- Content card --}}
                                <div class="flex-1 min-w-0 pt-0.5">
                                    <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/[0.02] p-5 sm:p-6 hover:border-[#a855f7]/30 hover:shadow-lg hover:shadow-purple-500/5 transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white exp-title" data-lang-en="{{ $exp['title_en'] ?? $exp['title'] }}" data-lang-tr="{{ $exp['title'] }}">{{ $exp['title'] }}</h3>
                                                @php
                                                    $companyTr = $exp['company'] . (!empty($exp['type']) ? ' · ' . $exp['type'] : '');
                                                    $companyEn = ($exp['company_en'] ?? $exp['company']) . (!empty($exp['type_en']) ? ' · ' . $exp['type_en'] : '');
                                                @endphp
                                                <p class="text-sm text-gray-600 dark:text-zinc-400 mt-0.5 exp-company" data-lang-en="{{ $companyEn }}" data-lang-tr="{{ $companyTr }}">{{ $companyTr }}</p>
                                            </div>
                                            <div class="text-xs sm:text-sm text-gray-500 dark:text-zinc-500 whitespace-nowrap exp-dates" data-lang-en="{{ ($exp['date_start_en'] ?? $exp['date_start']) }} – {{ ($exp['date_end_en'] ?? $exp['date_end']) }} · {{ ($exp['duration_en'] ?? $exp['duration']) }}" data-lang-tr="{{ $exp['date_start'] }} – {{ $exp['date_end'] }} · {{ $exp['duration'] }}">{{ $exp['date_start'] }} – {{ $exp['date_end'] }} · {{ $exp['duration'] }}</div>
                                        </div>
                                        @if(!empty($exp['location']))
                                        @php
                                            $locationTr = $exp['location'] . (!empty($exp['work_mode']) ? ' · ' . $exp['work_mode'] : '');
                                            $locationEn = ($exp['location_en'] ?? $exp['location']) . (!empty($exp['work_mode_en']) ? ' · ' . $exp['work_mode_en'] : '');
                                        @endphp
                                        <p class="mt-3 text-sm text-gray-500 dark:text-zinc-500 flex items-center gap-1.5">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                            <span class="exp-location" data-lang-en="{{ $locationEn }}" data-lang-tr="{{ $locationTr }}">{{ $locationTr }}</span>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <x-footer />
    </div>

    @php $contactModalOpen = session('contact_success') || session('contact_error') || $errors->any(); @endphp
    {{-- Contact modal --}}
    <div id="contact-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 {{ $contactModalOpen ? '' : 'hidden' }}" aria-hidden="{{ $contactModalOpen ? 'false' : 'true' }}">
        <div id="contact-backdrop" class="absolute inset-0 bg-gray-900/60 dark:bg-black/80 backdrop-blur-sm transition-opacity duration-200 cursor-pointer" aria-hidden="true"></div>
        <div id="contact-modal-panel" class="relative w-full max-w-md rounded-3xl overflow-hidden shadow-2xl transition-all duration-300 {{ $contactModalOpen ? 'opacity-100 scale-100 translate-y-0' : 'opacity-0 scale-[0.96] translate-y-4' }}">
            {{-- Gradient header strip --}}
            <div class="h-1.5 bg-gradient-to-r from-[#a855f7] via-[#7c3aed] to-[#6366f1]"></div>
            <div class="bg-white dark:bg-zinc-900/95 dark:border dark:border-white/5 p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white lang-modal-title" data-lang-en="Contact" data-lang-tr="İletişim">Contact</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-zinc-400 lang-modal-subtitle" data-lang-en="Send a message, I'll get back to you." data-lang-tr="Mesajınızı bırakın, size geri döneceğim.">Send a message, I'll get back to you.</p>
                    </div>
                    <button type="button" id="contact-close" class="rounded-full p-2.5 text-gray-400 dark:text-zinc-500 transition-colors hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-600 dark:hover:text-white" aria-label="Close">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                @if(session('contact_success'))
                    <div class="mb-4 flex items-center gap-2 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 px-4 py-3 text-sm text-emerald-700 dark:text-emerald-400">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span class="lang-success" data-lang-en="Message sent successfully." data-lang-tr="Mesajınız başarıyla gönderildi.">Message sent successfully.</span>
                    </div>
                @endif
                @if(session('contact_error'))
                    <div class="mb-4 flex items-center gap-2 rounded-xl bg-red-50 dark:bg-red-500/10 px-4 py-3 text-sm text-red-700 dark:text-red-400">{{ session('contact_error') }}</div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="contact-name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300 lang-modal-name" data-lang-en="Name" data-lang-tr="Ad">Name</label>
                        <input type="text" id="contact-name" name="name" required placeholder="Your name" data-placeholder-en="Your name" data-placeholder-tr="Adınız"
                            class="block w-full rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-zinc-500 transition-colors focus:border-[#a855f7] focus:bg-white dark:focus:bg-white/10 focus:ring-2 focus:ring-[#a855f7]/20 focus:outline-none"
                            value="{{ old('name') }}">
                        @error('name')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="contact-email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300">Email</label>
                        <input type="email" id="contact-email" name="email" required placeholder="Your email address" data-placeholder-en="Your email address" data-placeholder-tr="E-posta adresiniz"
                            class="block w-full rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-zinc-500 transition-colors focus:border-[#a855f7] focus:bg-white dark:focus:bg-white/10 focus:ring-2 focus:ring-[#a855f7]/20 focus:outline-none"
                            value="{{ old('email') }}">
                        @error('email')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="contact-message" class="mb-2 block text-sm font-medium text-gray-700 dark:text-zinc-300 lang-modal-message" data-lang-en="Message" data-lang-tr="Mesaj">Message</label>
                        <textarea id="contact-message" name="message" rows="4" required placeholder="Your message" data-placeholder-en="Your message" data-placeholder-tr="Mesajınız"
                            class="block w-full resize-none rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/5 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-zinc-500 transition-colors focus:border-[#a855f7] focus:bg-white dark:focus:bg-white/10 focus:ring-2 focus:ring-[#a855f7]/20 focus:outline-none">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="lang-modal-send w-full rounded-xl bg-gradient-to-r from-[#a855f7] to-[#7c3aed] px-4 py-3.5 text-base font-semibold text-white shadow-lg shadow-purple-500/25 transition-all hover:shadow-purple-500/40 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-[#a855f7] focus:ring-offset-2 dark:focus:ring-offset-zinc-900" data-lang-en="Send" data-lang-tr="Gönder">Send</button>
                </form>
            </div>
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
                document.querySelectorAll('[data-placeholder-en][data-placeholder-tr]').forEach(function (el) {
                    el.placeholder = el.getAttribute('data-placeholder-' + lang);
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

            function lockScroll() {
                var scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                document.body.style.paddingRight = scrollbarWidth + 'px';
                document.body.style.overflow = 'hidden';
            }

            function unlockScroll() {
                document.body.style.paddingRight = '';
                document.body.style.overflow = '';
            }

            function openContactModal() {
                contactModal.classList.remove('hidden');
                contactModal.classList.add('flex');
                lockScroll();
                requestAnimationFrame(function () {
                    contactPanel.classList.remove('opacity-0', 'scale-[0.96]', 'translate-y-4');
                    contactPanel.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                });
            }

            function closeContactModal() {
                contactPanel.classList.add('opacity-0', 'scale-[0.96]', 'translate-y-4');
                contactPanel.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                setTimeout(function () {
                    contactModal.classList.add('hidden');
                    contactModal.classList.remove('flex');
                    unlockScroll();
                }, 200);
            }

            if (contactOpen) contactOpen.addEventListener('click', openContactModal);
            if (contactClose) contactClose.addEventListener('click', closeContactModal);
            var contactBackdrop = document.getElementById('contact-backdrop');
            if (contactModal) contactModal.addEventListener('click', function (e) { if (e.target === contactModal || e.target === contactBackdrop) closeContactModal(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && contactModal && !contactModal.classList.contains('hidden')) closeContactModal(); });

            var expCards = document.querySelectorAll('.exp-card');
            if (expCards.length && 'IntersectionObserver' in window) {
                var expObs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('exp-visible');
                        }
                    });
                }, { rootMargin: '0px 0px -60px 0px', threshold: 0.1 });
                expCards.forEach(function (el) { expObs.observe(el); });
            }
        });
    </script>
</body>
</html>
