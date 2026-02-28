<header class="sticky top-0 z-30 border-b border-gray-200 dark:border-white/5 bg-white/90 dark:bg-transparent backdrop-blur-xl">
    <div class="relative mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            {{-- Sol: tema değiştir --}}
            <div class="flex w-10 sm:w-12 shrink-0 items-center justify-start">
                <button type="button" data-theme-toggle class="p-2 text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-accent-500/50 transition-colors" aria-label="Toggle theme">
                    <svg class="h-5 w-5 hidden dark:inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75 9.75 9.75 0 018.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25 9.75 9.75 0 0012.75 21c3.313 0 6.24-1.61 8.002-4.098z" />
                    </svg>
                    <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75V5.25M18.364 5.636L17.303 6.697M20.25 12H18.75M18.364 18.364L17.303 17.303M12 18.75V20.25M6.697 17.303L5.636 18.364M5.25 12H3.75M6.697 6.697L5.636 5.636M12 8.25A3.75 3.75 0 1012 15.75A3.75 3.75 0 0012 8.25Z" />
                    </svg>
                </button>
            </div>

            {{-- Orta: site adı --}}
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex h-16 items-center pointer-events-auto">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-zinc-200 transition-colors">
                    {{ $siteName ?? config('app.name') }}
                </a>
            </div>

            {{-- Sağ: profil + dil seçici (EN / TR bayrağı) --}}
            <div class="flex shrink-0 items-center justify-end gap-1">
                <button type="button" id="header-menu-toggle" class="p-2 text-gray-600 dark:text-zinc-400 hover:text-[#a855f7] dark:hover:text-[#a855f7] rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-[#a855f7]/50 transition-colors" aria-label="My info">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </button>
                <button type="button" id="lang-en" class="flex items-center justify-center w-9 h-9 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors" title="English" aria-label="English">
                    <span class="text-lg" role="img" aria-hidden="true">🇬🇧</span>
                </button>
                <button type="button" id="lang-tr" class="flex items-center justify-center w-9 h-9 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors" title="Türkçe" aria-label="Türkçe">
                    <span class="text-lg" role="img" aria-hidden="true">🇹🇷</span>
                </button>
            </div>
        </div>
    </div>
</header>

{{-- Sağdan kayan menü paneli --}}
<div id="header-menu-overlay" class="fixed inset-0 z-40 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300" aria-hidden="true"></div>
<aside id="header-menu-panel" class="fixed top-0 right-0 z-50 h-full w-full max-w-sm bg-gray-50 dark:bg-[#060a12] shadow-xl transform translate-x-full transition-transform duration-300 ease-out overflow-y-auto" aria-hidden="true">
    <div class="p-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white lang-panel-title" data-lang-en="My Info" data-lang-tr="Bilgilerim">My Info</h2>
            <button type="button" id="header-menu-close" class="p-2 text-gray-500 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors" aria-label="Close menu">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="space-y-4 text-gray-600 dark:text-zinc-400">
            <div class="flex gap-4 items-center p-4 rounded-xl bg-white dark:bg-white/5 border border-gray-200/50 dark:border-white/5">
                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-[#0A66C2]/20 flex items-center justify-center text-[#0A66C2]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-gray-500 dark:text-zinc-500 mb-0.5 lang-panel-profile" data-lang-en="Profile" data-lang-tr="Profil">Profile</p>
                    <p class="text-gray-900 dark:text-white font-medium truncate">{{ $userPanelName ?? 'Ömer Soft' }}</p>
                </div>
            </div>
            <div class="flex gap-4 items-center p-4 rounded-xl bg-white dark:bg-white/5 border border-gray-200/50 dark:border-white/5">
                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-[#0A66C2]/20 flex items-center justify-center text-[#0A66C2]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-gray-500 dark:text-zinc-500 mb-0.5 lang-panel-email" data-lang-en="Email" data-lang-tr="E-posta">Email</p>
                    @if($userPanelEmail ?? null)
                    <a href="mailto:{{ $userPanelEmail }}" class="text-[#0A66C2] hover:text-[#004182] hover:underline transition-colors truncate block">{{ $userPanelEmail }}</a>
                    @else
                    <span class="text-gray-500 dark:text-zinc-500">—</span>
                    @endif
                </div>
            </div>
            <div class="flex gap-4 items-center p-4 rounded-xl bg-white dark:bg-white/5 border border-gray-200/50 dark:border-white/5">
                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-[#0A66C2]/20 flex items-center justify-center text-[#0A66C2]">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-gray-500 dark:text-zinc-500 mb-0.5">LinkedIn</p>
                    @if($userPanelLinkedIn ?? null)
                    <a href="{{ $userPanelLinkedIn }}" target="_blank" rel="noopener noreferrer" class="text-[#0A66C2] hover:text-[#004182] hover:underline transition-colors truncate block">{{ preg_replace('#^https?://(www\.)?#', '', $userPanelLinkedIn) }}</a>
                    @else
                    <span class="text-gray-500 dark:text-zinc-500">—</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('header-menu-toggle');
    var closeBtn = document.getElementById('header-menu-close');
    var overlay = document.getElementById('header-menu-overlay');
    var panel = document.getElementById('header-menu-panel');

    function lockScroll() {
        var scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.paddingRight = scrollbarWidth + 'px';
        document.body.style.overflow = 'hidden';
    }

    function unlockScroll() {
        document.body.style.paddingRight = '';
        document.body.style.overflow = '';
    }

    function openMenu() {
        panel.classList.remove('translate-x-full');
        panel.setAttribute('aria-hidden', 'false');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.setAttribute('aria-hidden', 'false');
        lockScroll();
    }

    function closeMenu() {
        panel.classList.add('translate-x-full');
        panel.setAttribute('aria-hidden', 'true');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        overlay.setAttribute('aria-hidden', 'true');
        unlockScroll();
    }

    if (toggle) toggle.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && panel && !panel.classList.contains('translate-x-full')) {
            closeMenu();
        }
    });
});
</script>
