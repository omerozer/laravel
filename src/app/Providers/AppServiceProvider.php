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
            View::share('publicLogoPath', Setting::get('public_logo'));
            View::share('publicLogoWidth', (int) Setting::get('public_logo_width', 160));
            View::share('publicLogoHeight', (int) Setting::get('public_logo_height', 40));
            View::share('userPanelName', Setting::get('user_panel_name', 'Ömer Soft'));
            View::share('userPanelEmail', Setting::get('user_panel_email', 'iletisim@omersoft.com'));
            View::share('userPanelLinkedIn', Setting::get('user_panel_linkedin', 'https://www.linkedin.com/in/omerdesign/'));
            View::share('footerText', Setting::get('footer_text', '© {year} {app_name}. All rights reserved.'));
            View::share('seoHomeTitle', Setting::get('seo_home_title'));
            View::share('seoHomeDescription', Setting::get('seo_home_description'));
        } else {
            View::share('publicLogoPath', null);
            View::share('publicLogoWidth', 160);
            View::share('publicLogoHeight', 40);
            View::share('userPanelName', 'Ömer Soft');
            View::share('userPanelEmail', 'iletisim@omersoft.com');
            View::share('userPanelLinkedIn', 'https://www.linkedin.com/in/omerdesign/');
            View::share('footerText', '© {year} {app_name}. All rights reserved.');
            View::share('seoHomeTitle', null);
            View::share('seoHomeDescription', null);
        }
    }
}
