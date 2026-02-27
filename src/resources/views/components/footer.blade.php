<footer class="border-t border-gray-200 dark:border-white/5 bg-gray-100 dark:bg-black">
    <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Ana Sayfa
                </a>
                <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Blog
                </a>
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Admin
                </a>
            </div>
            <p class="text-sm text-gray-500 dark:text-zinc-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</footer>
