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
    @if(file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
</head>
<body class="h-full bg-gray-50 dark:bg-[linear-gradient(135deg,#1e1b4b_0%,#0f0a1e_35%,#020617_70%,#1e1b4b_100%)] dark:bg-fixed font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
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

        <x-footer />
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button[data-theme-toggle], a').forEach(function (el) { el.style.cursor = 'pointer'; });
        });
    </script>
</body>
</html>
