<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($faviconPath ?? null)
        <link rel="icon" href="{{ asset($faviconPath) }}" @if($faviconSize ?? null) sizes="{{ $faviconSize }}x{{ $faviconSize }}" @endif>
    @endif
    <title>{{ $siteName ?? config('app.name') }} - Filament UI Bileşenleri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-950 font-sans antialiased">
    <div class="min-h-full fi-body flex flex-col">
        {{-- Header --}}
        <header class="fi-header sticky top-0 z-30 border-b border-gray-200 dark:border-white/5 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-4">
                    <a href="{{ route('home') }}" class="cursor-pointer text-xl font-semibold text-gray-950 dark:text-white">
                        {{ config('app.name') }}
                    </a>
                    <nav class="flex items-center gap-2">
                        <button type="button"
                            data-theme-toggle
                            class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white/80 dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                            <span class="sr-only">Tema değiştir</span>
                            <svg class="h-5 w-5 hidden dark:inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75 9.75 9.75 0 018.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25 9.75 9.75 0 0012.75 21c3.313 0 6.24-1.61 8.002-4.098z" />
                            </svg>
                            <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75V5.25M18.364 5.636L17.303 6.697M20.25 12H18.75M18.364 18.364L17.303 17.303M12 18.75V20.25M6.697 17.303L5.636 18.364M5.25 12H3.75M6.697 6.697L5.636 5.636M12 8.25A3.75 3.75 0 1012 15.75A3.75 3.75 0 0012 8.25Z" />
                            </svg>
                        </button>
                        <a href="{{ route('home') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-gray fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-white/10 text-gray-950 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-gray-500/50 dark:focus:ring-white/50">
                            Ana Sayfa
                        </a>
                        <a href="{{ route('blog.index') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-gray fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-white/10 text-gray-950 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-gray-500/50 dark:focus:ring-white/50">
                            Blog
                        </a>
                        <a href="{{ route('components.gallery') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-primary fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-accent-500 text-white hover:bg-accent-600 focus:ring-accent-500/50 dark:bg-accent-500 dark:hover:bg-accent-600 dark:focus:ring-accent-500/50">
                            Filament UI
                        </a>
                        <a href="{{ url('/dashboard') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-gray fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-white/10 text-gray-950 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-gray-500/50 dark:focus:ring-white/50">
                            Admin
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="fi-main flex-1">
            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8 space-y-8">
                <header class="space-y-2">
                    <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                        Filament UI Bileşen Kütüphanesi
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Bu sayfa, projede kullanabileceğin Filament benzeri buton, form, alert, kart, tablo ve modal bileşenlerini bir arada gösterir.
                    </p>
                </header>

                {{-- Buttons --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Butonlar
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Primary, secondary, ghost, ikonlu, disabled, farklı boyutlar</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-4">
                            <div class="space-y-2">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Primary</p>
                                <div class="flex flex-wrap gap-3">
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg bg-accent-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                                        Primary
                                    </button>
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg bg-accent-500/90 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                                        Primary (Yoğun)
                                    </button>
                                    <button disabled class="fi-btn relative inline-flex items-center justify-center rounded-lg bg-accent-500/40 px-4 py-2 text-sm font-semibold text-white/70 shadow-sm cursor-not-allowed">
                                        Primary Disabled
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Gri / Secondary</p>
                                <div class="flex flex-wrap gap-3">
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 px-4 py-2 text-sm font-medium text-gray-900 dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-500/50 dark:focus:ring-white/50">
                                        Secondary
                                    </button>
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5 px-4 py-2 text-sm font-medium text-gray-900 dark:text-white shadow-sm hover:bg-gray-100 dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-500/50 dark:focus:ring-white/50">
                                        Subtle
                                    </button>
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-transparent bg-transparent px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 focus:outline-none">
                                        Ghost
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">İkonlu</p>
                                <div class="flex flex-wrap gap-3">
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center gap-2 rounded-lg bg-accent-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                        Yeni Kayıt
                                    </button>
                                    <button class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 px-2.5 py-2 text-sm font-medium text-gray-900 dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-500/50 dark:focus:ring-white/50">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5.433 13.917l1.262-.252a3 3 0 001.63-.846l6.306-6.306a1.5 1.5 0 00-2.121-2.121L6.203 10.698a3 3 0 00-.846 1.63l-.252 1.262a.75.75 0 00.672.872.764.764 0 00.156-.015z" />
                                            <path d="M3.5 5.75A2.25 2.25 0 015.75 3.5H8a.75.75 0 000-1.5H5.75A3.75 3.75 0 002 5.75v8.5A3.75 3.75 0 005.75 18h8.5A3.75 3.75 0 0018 14.25V12a.75.75 0 00-1.5 0v2.25A2.25 2.25 0 0114.25 16.5h-8.5A2.25 2.25 0 013.5 14.25v-8.5z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Form fields --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Form Alanları
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Input, select, textarea, checkbox, switch, hata durumu</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-6">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Metin Alanı</span>
                                        <span class="fi-fo-field-wrp-required indicator flex text-danger-500">*</span>
                                    </label>
                                    <input type="text" class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-accent-500 focus:ring-accent-500 dark:focus:border-accent-500 dark:focus:ring-accent-500 sm:text-sm" placeholder="Örnek metin">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Yardımcı açıklama metni.</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">E-posta (Hatalı)</span>
                                    </label>
                                    <input type="email" class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-danger-300 dark:border-danger-500/60 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-danger-500 focus:ring-danger-500 dark:focus:border-danger-500 dark:focus:ring-danger-500 sm:text-sm" value="hatalı mail">
                                    <p class="fi-fo-field-wrp-error-message text-xs text-danger-600 dark:text-danger-400">Geçerli bir e-posta girin.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Seçim</span>
                                    </label>
                                    <select class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-accent-500 focus:ring-accent-500 dark:focus:border-accent-500 dark:focus:ring-accent-500 sm:text-sm">
                                        <option>Seçenek 1</option>
                                        <option>Seçenek 2</option>
                                        <option>Seçenek 3</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Textarea</span>
                                    </label>
                                    <textarea rows="3" class="fi-input block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-accent-500 focus:ring-accent-500 dark:focus:border-accent-500 dark:focus:ring-accent-500 sm:text-sm" placeholder="Daha uzun metin"></textarea>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2">
                                        <input id="checkbox-ornek" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-accent-500 focus:ring-accent-500">
                                        <label for="checkbox-ornek" class="text-sm text-gray-700 dark:text-gray-200">Checkbox örneği</label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="radio-1" name="radio-ornek" type="radio" class="h-4 w-4 border-gray-300 text-accent-500 focus:ring-accent-500">
                                        <label for="radio-1" class="text-sm text-gray-700 dark:text-gray-200">Radio 1</label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="radio-2" name="radio-ornek" type="radio" class="h-4 w-4 border-gray-300 text-accent-500 focus:ring-accent-500">
                                        <label for="radio-2" class="text-sm text-gray-700 dark:text-gray-200">Radio 2</label>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Toggle / Switch</p>
                                    <button type="button" class="cursor-pointer inline-flex items-center rounded-full border border-transparent bg-gray-200 dark:bg-gray-700 p-0.5 transition hover:bg-gray-300 dark:hover:bg-gray-600">
                                        <span class="sr-only">Bildirimleri aç/kapat</span>
                                        <span class="inline-flex h-5 w-5 transform rounded-full bg-white shadow ring-1 ring-gray-900/10"></span>
                                    </button>
                                    <button type="button" class="cursor-pointer inline-flex items-center rounded-full border border-transparent bg-accent-500 p-0.5 transition hover:bg-accent-600">
                                        <span class="sr-only">Bildirimleri aç/kapat</span>
                                        <span class="inline-flex h-5 w-5 transform rounded-full bg-white shadow ring-1 ring-accent-600 translate-x-5"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Alerts & badges --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Alert & Badge
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Başarı, bilgi, uyarı, hata banner’ları ve küçük etiketler</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="p-3 rounded-lg bg-green-50 dark:bg-green-500/10 text-sm text-green-700 dark:text-green-400 flex items-center gap-2">
                                    <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-300 text-xs font-semibold">✓</span>
                                    Başarılı işlem örneği.
                                </div>
                                <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-sm text-blue-700 dark:text-blue-300">
                                    Bilgilendirme mesajı örneği.
                                </div>
                                <div class="p-3 rounded-lg bg-accent-50 dark:bg-accent-500/10 text-sm text-accent-700 dark:text-accent-300">
                                    Uyarı mesajı örneği.
                                </div>
                                <div class="p-3 rounded-lg bg-red-50 dark:bg-red-500/10 text-sm text-red-700 dark:text-red-300">
                                    Hata mesajı örneği.
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Badge / Etiket</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center rounded-full bg-accent-50 px-2.5 py-1 text-xs font-medium text-accent-700 dark:bg-accent-500/15 dark:text-accent-300">
                                        Durum: Aktif
                                    </span>
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                        Taslak
                                    </span>
                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 dark:bg-red-500/15 dark:text-red-300">
                                        Hata
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Notifications (toast sağ alttan) --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Notification
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Sağ alttan toast — butona tıkla, bildirim sağ altta görünsün</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Aşağıdaki butonlara tıklayarak sağ alt köşede beliren bildirimleri deneyebilirsin. Otomatik kapanır veya X ile kapatılabilir.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button type="button" data-notify="success" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500/50">
                                    Success
                                </button>
                                <button type="button" data-notify="danger" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/50">
                                    Danger
                                </button>
                                <button type="button" data-notify="warning" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-accent-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-accent-700 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                                    Warning
                                </button>
                                <button type="button" data-notify="info" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                    Info
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Cards / Table (layout) --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Kart & Tablo
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Filament benzeri kart ve tablo yerleşimi</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-6">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-4">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Toplam Kişi</p>
                                    <p class="mt-2 text-2xl font-semibold text-gray-950 dark:text-white">128</p>
                                </div>
                                <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-4">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Bugün Eklenen</p>
                                    <p class="mt-2 text-2xl font-semibold text-gray-950 dark:text-white">5</p>
                                </div>
                                <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-4">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Aktif Admin</p>
                                    <p class="mt-2 text-2xl font-semibold text-gray-950 dark:text-white">2</p>
                                </div>
                            </div>

                            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-white/10">
                                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5">
                                    <thead class="bg-gray-50 dark:bg-white/5">
                                        <tr>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300">Ad</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300">Durum</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300">Rol</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="fi-ta-row hover:bg-gray-50 dark:hover:bg-white/5">
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">Demo Kullanıcı</td>
                                            <td class="fi-ta-cell px-4 py-3">
                                                <span class="inline-flex items-center rounded-full bg-accent-50 px-2.5 py-1 text-xs font-medium text-accent-700 dark:bg-accent-500/15 dark:text-accent-300">
                                                    Aktif
                                                </span>
                                            </td>
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-700 dark:text-gray-200">Admin</td>
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                <button type="button" class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-2.5 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5">
                                                    Düzenle
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="fi-ta-row hover:bg-gray-50 dark:hover:bg-white/5">
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">Diğer Kullanıcı</td>
                                            <td class="fi-ta-cell px-4 py-3">
                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                                    Pasif
                                                </span>
                                            </td>
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-700 dark:text-gray-200">User</td>
                                            <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                <button type="button" class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-2.5 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5">
                                                    Görüntüle
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Modal örneği --}}
                <section class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="fi-section-header flex items-center justify-between gap-x-3 border-b border-gray-200 dark:border-white/5 px-6 py-4">
                        <h2 class="fi-section-header-heading text-sm font-semibold text-gray-950 dark:text-white">
                            Modal
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Filament benzeri modal görünümü</p>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6 space-y-4">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Aşağıdaki örnek modal her zaman açık; tasarımını görmek için kullanabilirsin.
                            </p>
                            <div class="relative z-10 flex min-h-full items-center justify-center px-4 py-8 bg-gray-50 dark:bg-gray-900/40 rounded-xl border border-dashed border-gray-200 dark:border-white/10">
                                <div class="w-full max-w-lg rounded-xl bg-white dark:bg-gray-900 shadow-lg ring-1 ring-gray-950/5 dark:ring-white/10">
                                    <div class="flex items-center justify-between border-b border-gray-200 dark:border-white/10 px-6 py-4">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                            Örnek Modal Başlığı
                                        </h3>
                                        <button type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none">
                                            <span class="sr-only">Kapat</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="px-6 py-5 space-y-4">
                                        <p class="text-sm text-gray-700 dark:text-gray-200">
                                            Bu sadece tasarımsal bir örnektir. Gerçek modal davranışı için mevcut düzenleme modalindeki yapı tekrar kullanılabilir.
                                        </p>
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-200">Alan 1</label>
                                                <input type="text" class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-accent-500 focus:ring-accent-500 dark:focus:border-accent-500 dark:focus:ring-accent-500 sm:text-xs">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-200">Alan 2</label>
                                                <input type="text" class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-accent-500 focus:ring-accent-500 dark:focus:border-accent-500 dark:focus:ring-accent-500 sm:text-xs">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-3 border-t border-gray-200 dark:border-white/10 px-6 py-4">
                                        <button type="button" class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-4 py-2 text-xs font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-500/50 dark:focus:ring-white/50">
                                            Vazgeç
                                        </button>
                                        <button type="button" class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg bg-accent-500 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                                            Kaydet
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    {{-- Toast container: sağ alt köşe --}}
    <div id="notification-toast-container" class="fixed bottom-4 right-4 z-[100] flex flex-col-reverse gap-3 pointer-events-none w-full max-w-sm sm:max-w-md" aria-live="polite"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button, [role="button"], .fi-btn').forEach(function (el) {
                el.style.cursor = 'pointer';
            });
        });
    </script>
</body>
</html>

