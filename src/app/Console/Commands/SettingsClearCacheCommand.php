<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SettingsClearCacheCommand extends Command
{
    protected $signature = 'settings:clear-cache';

    protected $description = 'Clear the settings cache so footer, SEO, logo etc. reload from database';

    public function handle(): int
    {
        Cache::forget('settings');

        $this->info('Settings cache cleared. Footer, SEO, logo and other settings will reload from database.');

        return self::SUCCESS;
    }
}
