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

        // Dashboard login ve panel Türkçe
        if (request()->is('dashboard*')) {
            app()->setLocale('tr');
        }

        $siteWidth = Schema::hasTable('settings')
            ? Setting::get('site_width', 'max-w-7xl')
            : 'max-w-7xl';
        View::share('siteWidth', $siteWidth === 'full' ? 'max-w-full' : $siteWidth);

        $siteName = Schema::hasTable('settings')
            ? (Setting::get('site_name') ?? config('app.name'))
            : config('app.name');
        View::share('siteName', $siteName);

        if (Schema::hasTable('settings')) {
            View::share('faviconPath', Setting::get('favicon'));
            View::share('faviconSize', (int) Setting::get('favicon_size', 32));
            View::share('heroAvatar', Setting::get('hero_avatar', 'images/omer.jpeg'));
            View::share('heroTitle1En', Setting::get('hero_title_1_en', 'Software That Runs Your'));
            View::share('heroTitle1Tr', Setting::get('hero_title_1_tr', 'İşlerinizi Yöneten'));
            View::share('heroTitle2En', Setting::get('hero_title_2_en', 'Operations'));
            View::share('heroTitle2Tr', Setting::get('hero_title_2_tr', 'Özel Yazılımlar'));
            View::share('heroSubtitleEn', Setting::get('hero_subtitle_en', 'I build internal systems that automate daily work and keep your operations running without constant supervision.'));
            View::share('heroSubtitleTr', Setting::get('hero_subtitle_tr', 'İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.'));
            View::share('userPanelName', Setting::get('user_panel_name', 'Ömer Soft'));
            View::share('userPanelEmail', Setting::get('user_panel_email', 'iletisim@omersoft.com'));
            View::share('userPanelLinkedIn', Setting::get('user_panel_linkedin', 'https://www.linkedin.com/in/omerdesign/'));
            View::share('footerText', Setting::get('footer_text', '© {year} {app_name}. All rights reserved.'));
            View::share('socialLinkedin', Setting::get('social_linkedin') ?: Setting::get('user_panel_linkedin', ''));
            View::share('socialBehance', Setting::get('social_behance', ''));
            View::share('socialGithub', Setting::get('social_github', ''));
            View::share('seoHomeTitle', Setting::get('seo_home_title'));
            View::share('seoHomeDescription', Setting::get('seo_home_description'));
        } else {
            View::share('faviconPath', null);
            View::share('faviconSize', 32);
            View::share('heroAvatar', 'images/omer.jpeg');
            View::share('heroTitle1En', 'Software That Runs Your');
            View::share('heroTitle1Tr', 'İşlerinizi Yöneten');
            View::share('heroTitle2En', 'Operations');
            View::share('heroTitle2Tr', 'Özel Yazılımlar');
            View::share('heroSubtitleEn', 'I build internal systems that automate daily work and keep your operations running without constant supervision.');
            View::share('heroSubtitleTr', 'İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.');
            View::share('userPanelName', 'Ömer Soft');
            View::share('userPanelEmail', 'iletisim@omersoft.com');
            View::share('userPanelLinkedIn', 'https://www.linkedin.com/in/omerdesign/');
            View::share('footerText', '© {year} {app_name}. All rights reserved.');
            View::share('socialLinkedin', '');
            View::share('socialBehance', '');
            View::share('socialGithub', '');
            View::share('seoHomeTitle', null);
            View::share('seoHomeDescription', null);
        }
    }
}
