<?php

namespace App\Providers;

use App\Http\Responses\Auth\LoginResponse;
use App\Models\Setting;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(LoginResponseContract::class, LoginResponse::class);

        $siteWidth = Schema::hasTable('settings')
            ? Setting::get('site_width', 'max-w-7xl')
            : 'max-w-7xl';
        View::share('siteWidth', $siteWidth === 'full' ? 'max-w-full' : $siteWidth);

        if (Schema::hasTable('settings')) {
            $publicLogo = Setting::get('public_logo');
            View::share('publicLogoUrl', $publicLogo ? route('settings.media', ['path' => $publicLogo]) : null);
            View::share('publicLogoWidth', (int) Setting::get('public_logo_width', 160));
            View::share('publicLogoHeight', (int) Setting::get('public_logo_height', 40));
        } else {
            View::share('publicLogoUrl', null);
            View::share('publicLogoWidth', 160);
            View::share('publicLogoHeight', 40);
        }
    }
}
