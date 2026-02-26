<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->meta_title ?? $post->title }} - {{ config('app.name') }}</title>
    @if($post->meta_description)
        <meta name="description" content="{{ $post->meta_description }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fonts/filament/filament/inter/index.css') }}">
</head>
<body class="h-full bg-gray-50 dark:bg-black font-sans antialiased text-gray-900 dark:text-white">
    <div class="min-h-full flex flex-col">
        <x-header />

        <main class="flex-1">
            <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                    {{-- Sol sidebar: H2 başlıkları (scrollspy) --}}
                    <aside id="toc-sidebar" class="hidden lg:block lg:w-64 flex-shrink-0">
                        <nav class="sticky top-24 border border-gray-200 dark:border-zinc-700 rounded-xl p-4 bg-white/50 dark:bg-zinc-900/50">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-zinc-500 mb-4">Bu sayfada</p>
                            <div id="toc-list" class="space-y-0.5">
                                {{-- JS ile doldurulacak --}}
                            </div>
                        </nav>
                    </aside>

                    {{-- Ana içerik --}}
                    <article class="min-w-0 flex-1 max-w-3xl">
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white transition-colors mb-8">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                            Bloga dön
                        </a>

                        @if($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}" class="inline-block text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 dark:hover:text-amber-300 transition-colors">{{ $post->category->name }}</a>
                        @endif
                        <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">{{ $post->title }}</h1>
                        <p class="mt-3 text-sm text-gray-500 dark:text-zinc-500">{{ $post->published_at?->format('d F Y') }} · {{ $post->author->name ?? '' }} · {{ $post->view_count }} görüntülenme</p>

                        @if($post->image)
                            <img src="{{ '/storage/'.$post->image }}" alt="" class="mt-8 w-full rounded-xl object-cover max-h-[28rem]">
                        @endif

                        @if($post->excerpt)
                            <p class="mt-8 text-lg leading-relaxed text-gray-600 dark:text-zinc-300">{{ $post->excerpt }}</p>
                        @endif

                        <div class="blog-post-content mt-8 prose prose-lg prose-invert max-w-none prose-headings:scroll-mt-24">
                            {!! $post->content !!}
                        </div>
                    </article>
                </div>
            </div>
        </main>

        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('button[data-theme-toggle], a').forEach(function (el) { el.style.cursor = 'pointer'; });

            var content = document.querySelector('.blog-post-content');
            if (!content) return;

            var h2s = content.querySelectorAll('h2');
            if (h2s.length === 0) return;

            var tocList = document.getElementById('toc-list');
            var sidebar = document.getElementById('toc-sidebar');
            if (!tocList || !sidebar) return;

            sidebar.classList.remove('hidden');

            var items = [];
            h2s.forEach(function(h2, i) {
                var id = 'section-' + i;
                h2.id = id;
                h2.setAttribute('data-toc-id', id);
                var text = h2.textContent.trim();
                var link = document.createElement('a');
                link.href = '#' + id;
                link.className = 'toc-link flex items-center gap-2 px-3 py-2 text-sm rounded-lg text-gray-500 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5 transition-colors';
                link.innerHTML = '<span class="text-amber-400/80"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg></span><span>' + text + '</span>';
                tocList.appendChild(link);
                items.push({ id: id, link: link, el: h2 });
            });

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (!entry.isIntersecting) return;
                    var id = entry.target.id;
                    items.forEach(function(item) {
                        item.link.classList.remove('toc-link-active');
                        if (item.id === id) {
                            item.link.classList.add('toc-link-active');
                        }
                    });
                });
            }, { rootMargin: '-100px 0px -60% 0px', threshold: 0 });

            items.forEach(function(item) { observer.observe(item.el); });
        });
    </script>
</body>
</html>
