<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Kayıt Formu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fonts/filament/filament/inter/index.css') }}">
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
                    <a href="{{ url('/') }}" class="cursor-pointer text-xl font-semibold text-gray-950 dark:text-white">
                        {{ config('app.name') }}
                    </a>
                    <nav class="flex items-center gap-2">
                        <button type="button"
                            data-theme-toggle
                            class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white/80 dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                            <span class="sr-only">Tema değiştir</span>
                            <svg class="h-5 w-5 hidden dark:inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75 9.75 9.75 0 018.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25 9.75 9.75 0 0012.75 21c3.313 0 6.24-1.61 8.002-4.098z" />
                            </svg>
                            <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75V5.25M18.364 5.636L17.303 6.697M20.25 12H18.75M18.364 18.364L17.303 17.303M12 18.75V20.25M6.697 17.303L5.636 18.364M5.25 12H3.75M6.697 6.697L5.636 5.636M12 8.25A3.75 3.75 0 1012 15.75A3.75 3.75 0 0012 8.25Z" />
                            </svg>
                        </button>
                        <a href="{{ url('/') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-primary fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-500 text-white hover:bg-amber-600 focus:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-600 dark:focus:ring-amber-500/50">
                            Kayıt Formu
                        </a>
                        <a href="{{ url('/control') }}" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-gray fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-white/10 text-gray-950 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-gray-500/50 dark:focus:ring-white/50">
                            Admin
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="fi-main flex-1">
            <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
                <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white mb-6">
                    Kayıt Formu
                </h1>

                @if(session('success'))
                    <div class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 mb-6 overflow-hidden">
                        <div class="p-4 fi-ta-content flex items-center gap-2 text-sm text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-500/10 rounded-lg">
                            <svg class="h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                {{-- Form card --}}
                <div class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden mb-8">
                    <div class="fi-section-content-ctn">
                        <div class="fi-section-content p-6">
                            <form action="{{ route('kisi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="ad" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Ad</span>
                                            <span class="fi-fo-field-wrp-required indicator flex text-danger-500">*</span>
                                        </label>
                                        <input type="text" id="ad" name="ad" value="{{ old('ad') }}" required
                                            class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('ad')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="soyad" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Soyad</span>
                                            <span class="fi-fo-field-wrp-required indicator flex text-danger-500">*</span>
                                        </label>
                                        <input type="text" id="soyad" name="soyad" value="{{ old('soyad') }}" required
                                            class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('soyad')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="yas" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Yaş</span>
                                            <span class="fi-fo-field-wrp-required indicator flex text-danger-500">*</span>
                                        </label>
                                        <input type="number" id="yas" name="yas" value="{{ old('yas') }}" min="1" max="150" required
                                            class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('yas')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="email" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">E-posta</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com"
                                            class="fi-input block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('email')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="gorsel" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Görsel</span>
                                    </label>
                                    <input type="file" id="gorsel" name="gorsel" accept="image/jpeg,image/png,image/gif,image/jpg"
                                        class="fi-input block w-full text-sm text-gray-500 file:me-2 file:rounded-lg file:border-0 file:bg-amber-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-amber-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:file:bg-amber-500 dark:hover:file:bg-amber-600">
                                    @error('gorsel')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <button type="submit" class="fi-btn cursor-pointer relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-primary fi-size-md gap-1.5 px-4 py-2.5 text-sm inline-grid shadow-sm bg-amber-500 text-white hover:bg-amber-600 focus:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-600 dark:focus:ring-amber-500/50">
                                        Kaydet
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Table card --}}
                <div class="fi-section rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden">
                    <div class="fi-section-header flex items-center gap-x-3 p-6">
                        <h2 class="fi-section-header-heading text-lg font-bold text-gray-950 dark:text-white">
                            Kayıtlı Kişiler
                        </h2>
                    </div>
                    <div class="fi-section-content-ctn">
                        <div class="overflow-x-auto">
                            @if($kisiler->isEmpty())
                                <div class="fi-ta-empty-state p-12 text-center">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Henüz kayıt yok. Yukarıdaki formdan ekleyebilirsiniz.</p>
                                </div>
                            @else
                                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5">
                                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="bg-gray-50 dark:bg-white/5">
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">Görsel</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">Ad</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">Soyad</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">Yaş</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">E-posta</th>
                                            <th class="fi-ta-header-cell px-4 py-3 text-start text-sm font-semibold text-gray-950 dark:text-white">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                        @foreach($kisiler as $kisi)
                                            <tr class="fi-ta-row transition duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                                <td class="fi-ta-cell px-4 py-3">
                                                    @if($kisi->gorsel)
                                                        <img src="{{ '/storage/'.$kisi->gorsel }}" alt="" class="h-10 w-10 rounded-lg object-cover ring-1 ring-gray-950/5 dark:ring-white/10">
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">—</span>
                                                    @endif
                                                </td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->ad }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->soyad }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->yas }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $kisi->email ?? '—' }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                    <button type="button"
                                                        class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-2.5 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-amber-500/50"
                                                        data-id="{{ $kisi->id }}"
                                                        data-ad="{{ $kisi->ad }}"
                                                        data-soyad="{{ $kisi->soyad }}"
                                                        data-yas="{{ $kisi->yas }}"
                                                        data-email="{{ $kisi->email }}"
                                                        data-action="{{ route('kisi.update', $kisi) }}"
                                                        onclick="window.openEditKisiModal(this)">
                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M5.433 13.917l1.262-.252a3 3 0 001.63-.846l6.306-6.306a1.5 1.5 0 00-2.121-2.121L6.203 10.698a3 3 0 00-.846 1.63l-.252 1.262a.75.75 0 00.672.872.764.764 0 00.156-.015z" />
                                                            <path d="M3.5 5.75A2.25 2.25 0 015.75 3.5H8a.75.75 0 000-1.5H5.75A3.75 3.75 0 002 5.75v8.5A3.75 3.75 0 005.75 18h8.5A3.75 3.75 0 0018 14.25V12a.75.75 0 00-1.5 0v2.25A2.25 2.25 0 0114.25 16.5h-8.5A2.25 2.25 0 013.5 14.25v-8.5z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Edit modal --}}
                <div id="edit-kisi-modal" class="fixed inset-0 z-40 hidden">
                    <div data-edit-modal-overlay class="absolute inset-0 bg-gray-900/50 dark:bg-black/60 backdrop-blur-sm"></div>
                    <div class="relative z-10 flex min-h-full items-center justify-center px-4 py-8">
                        <div class="w-full max-w-lg rounded-xl bg-white dark:bg-gray-900 shadow-lg ring-1 ring-gray-950/5 dark:ring-white/10">
                            <div class="flex items-center justify-between border-b border-gray-200 dark:border-white/10 px-6 py-4">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    Kişiyi Düzenle
                                </h3>
                                <button type="button" data-edit-modal-close class="cursor-pointer text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none">
                                    <span class="sr-only">Kapat</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <form method="POST" enctype="multipart/form-data" class="px-6 py-5 space-y-5">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Ad</label>
                                        <input type="text" name="ad" required
                                            class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Soyad</label>
                                        <input type="text" name="soyad" required
                                            class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Yaş</label>
                                        <input type="number" name="yas" min="1" max="150" required
                                            class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">E-posta</label>
                                        <input type="email" name="email"
                                            class="mt-1 block w-full h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Yeni Görsel (isteğe bağlı)</label>
                                    <input type="file" name="gorsel" accept="image/jpeg,image/png,image/gif,image/jpg"
                                        class="mt-1 block w-full text-sm text-gray-500 file:me-2 file:rounded-lg file:border-0 file:bg-amber-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-amber-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:file:bg-amber-500 dark:hover:file:bg-amber-600">
                                </div>
                                <div class="flex justify-end gap-3 pt-2">
                                    <button type="button" data-edit-modal-close
                                        class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-gray-500/50 dark:focus:ring-white/50">
                                        Vazgeç
                                    </button>
                                    <button type="submit"
                                        class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                                        Kaydı Güncelle
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button, [role="button"], .fi-btn').forEach(function (el) {
                el.style.cursor = 'pointer';
            });
        });
    </script>
</body>
</html>
