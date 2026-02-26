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
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-950 dark:text-white">
                        {{ config('app.name') }}
                    </a>
                    <nav class="flex items-center gap-2">
                        <a href="{{ url('/') }}" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-primary fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-500 text-white hover:bg-amber-600 focus:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-600 dark:focus:ring-amber-500/50">
                            Kayıt Formu
                        </a>
                        <a href="{{ url('/admin') }}" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-gray fi-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-white/10 text-gray-950 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-gray-500/50 dark:focus:ring-white/50">
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
                                            class="fi-input block w-full rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('ad')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="soyad" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Soyad</span>
                                            <span class="fi-fo-field-wrp-required indicator flex text-danger-500">*</span>
                                        </label>
                                        <input type="text" id="soyad" name="soyad" value="{{ old('soyad') }}" required
                                            class="fi-input block w-full rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
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
                                            class="fi-input block w-full rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
                                        @error('yas')<p class="fi-fo-field-wrp-error-message mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="email" class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">E-posta</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com"
                                            class="fi-input block w-full rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-500 dark:focus:ring-amber-500 sm:text-sm">
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
                                    <button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg fi-btn-color-primary fi-size-md gap-1.5 px-4 py-2.5 text-sm inline-grid shadow-sm bg-amber-500 text-white hover:bg-amber-600 focus:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-600 dark:focus:ring-amber-500/50">
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
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                        @foreach($kisiler as $kisi)
                                            <tr class="fi-ta-row transition duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                                <td class="fi-ta-cell px-4 py-3">
                                                    @if($kisi->gorsel)
                                                        <img src="{{ Storage::url($kisi->gorsel) }}" alt="" class="h-10 w-10 rounded-lg object-cover ring-1 ring-gray-950/5 dark:ring-white/10">
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">—</span>
                                                    @endif
                                                </td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->ad }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->soyad }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-950 dark:text-white">{{ $kisi->yas }}</td>
                                                <td class="fi-ta-cell px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $kisi->email ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
