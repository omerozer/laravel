<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($faviconPath ?? null)
        <link rel="icon" href="{{ asset($faviconPath) }}" @if($faviconSize ?? null) sizes="{{ $faviconSize }}x{{ $faviconSize }}" @endif>
    @endif
    <title>Blog - {{ $siteName ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-950 font-sans antialiased">
    <div class="min-h-full fi-body flex flex-col">
        <header class="fi-header sticky top-0 z-30 border-b border-gray-200 dark:border-white/5 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl">
            <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-4">
                    <a href="{{ route('home') }}" class="cursor-pointer text-xl font-semibold text-gray-950 dark:text-white">{{ config('app.name') }}</a>
                    <nav class="flex items-center gap-2">
                        <button type="button" data-theme-toggle class="fi-btn cursor-pointer relative inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-accent-500/50">
                            <span class="sr-only">Tema</span>
                            <svg class="h-5 w-5 hidden dark:inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75 9.75 9.75 0 018.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25 9.75 9.75 0 0012.75 21c3.313 0 6.24-1.61 8.002-4.098z" /></svg>
                            <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75V5.25M18.364 5.636L17.303 6.697M20.25 12H18.75M18.364 18.364L17.303 17.303M12 18.75V20.25M6.697 17.303L5.636 18.364M5.25 12H3.75M6.697 6.697L5.636 5.636M12 8.25A3.75 3.75 0 1012 15.75A3.75 3.75 0 0012 8.25Z" /></svg>
                        </button>
                        <a href="{{ route('home') }}" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5">Ana Sayfa</a>
                        <a href="{{ route('blog.index') }}" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-accent-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600">Blog</a>
                        <a href="{{ url('/dashboard') }}" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-white/5">Admin</a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="fi-main flex-1">
            <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 py-8 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white mb-6">
                    Blog
                </h1>

                @if(isset($currentCategory))
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Kategori: <strong>{{ $currentCategory->name }}</strong></p>
                @endif

                {{-- Filtre / Arama --}}
                <div class="mb-8 flex flex-wrap items-center gap-4">
                    <form action="{{ route('blog.index') }}" method="get" class="flex gap-2 flex-1 min-w-[200px]">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Ara..." class="fi-input block w-full max-w-xs h-10 px-3 py-2 rounded-lg border border-gray-300 dark:border-white/20 dark:bg-white/5 text-gray-950 dark:text-white text-sm">
                        <button type="submit" class="fi-btn cursor-pointer inline-flex items-center justify-center rounded-lg bg-accent-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-600">Ara</button>
                    </form>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('blog.index') }}" class="fi-btn cursor-pointer inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium {{ !request('kategori') && !isset($currentCategory) ? 'bg-accent-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600' }}">Tümü</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('blog.category', $cat->slug) }}" class="fi-btn cursor-pointer inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium {{ (isset($currentCategory) && $currentCategory->id === $cat->id) ? 'bg-accent-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="fi-section cursor-pointer rounded-xl bg-white dark:bg-gray-900/50 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden hover:ring-accent-500/50 dark:hover:ring-accent-500/30 transition">
                            @if($post->image)
                                <img src="{{ '/storage/'.$post->image }}" alt="" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" /></svg>
                                </div>
                            @endif
                            <div class="p-4">
                                @if($post->category)
                                    <span class="text-xs font-medium text-accent-500">{{ $post->category->name }}</span>
                                @endif
                                <h2 class="mt-1 text-lg font-semibold text-gray-950 dark:text-white line-clamp-2">{{ $post->title }}</h2>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-500">{{ $post->published_at?->format('d.m.Y') }} · {{ $post->author->name ?? '' }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">Henüz yazı yok.</div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button[data-theme-toggle], .fi-btn, a').forEach(function (el) { el.style.cursor = 'pointer'; });
        });
    </script>
</body>
</html>
