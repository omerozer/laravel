<footer class="border-t border-gray-200 dark:border-white/5 bg-gray-100 dark:bg-black">
    <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <p class="text-sm text-gray-500 dark:text-zinc-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. {{ $footerText ?? 'All rights reserved.' }}
            </p>
        </div>
    </div>
</footer>
