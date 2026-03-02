<footer class="border-t border-gray-200 dark:border-white/5 bg-gray-100 dark:bg-black">
    <div class="mx-auto {{ $siteWidth ?? 'max-w-7xl' }} px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col items-center justify-center gap-6">
            @if(($socialLinkedin ?? '') || ($socialBehance ?? '') || ($socialGithub ?? ''))
            <div class="flex items-center gap-4">
                @if($socialLinkedin ?? '')
                <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg text-gray-500 dark:text-zinc-400 hover:text-[#0A66C2] hover:bg-gray-200/50 dark:hover:bg-white/5 transition-colors" aria-label="LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                @endif
                @if($socialBehance ?? '')
                <a href="{{ $socialBehance }}" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg text-gray-500 dark:text-zinc-400 hover:text-[#1769ff] hover:bg-gray-200/50 dark:hover:bg-white/5 transition-colors" aria-label="Behance">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-5.101 3-3.074 0-5.564-1.729-5.564-5.675 0-3.94 2.49-5.764 5.564-5.764 2.925 0 4.963 1.562 5.374 4h-3.093c-.336-1.044-1.547-1.636-2.281-1.636-1.466 0-2.281 1.215-2.281 3.4 0 2.185.815 3.4 2.281 3.4.734 0 1.945-.592 2.281-1.636h3.093zm-7.686-4h4.965c-.105-1.547-1.165-2.219-2.48-2.219-1.355 0-2.485.672-2.485 2.219zm-9.574 6.988h-6.466v-13.988h6.953c1.709 0 2.776 1.034 2.776 2.587 0 1.558-1.065 2.588-2.776 2.588h-.487v4.813zm-3.487-7.988h3.5c1.136 0 1.905.578 1.905 1.5 0 .921-.769 1.5-1.905 1.5h-3.5v-3zm.176-4.5h3.324c1.055 0 1.671.514 1.671 1.5 0 .986-.616 1.5-1.671 1.5h-3.324v-3z"/></svg>
                </a>
                @endif
                @if($socialGithub ?? '')
                <a href="{{ $socialGithub }}" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg text-gray-500 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-200/50 dark:hover:bg-white/5 transition-colors" aria-label="GitHub">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                </a>
                @endif
            </div>
            @endif
            <p class="text-sm text-gray-500 dark:text-zinc-500">
                {{ str_replace(['{year}', '{app_name}'], [date('Y'), $siteName ?? config('app.name')], $footerText ?? '© {year} {app_name}. All rights reserved.') }}
            </p>
        </div>
    </div>
</footer>
