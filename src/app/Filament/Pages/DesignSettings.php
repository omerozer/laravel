<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class DesignSettings extends \Filament\Pages\Page
{

    protected static ?string $navigationLabel = 'Ayarlar';

    protected static ?string $title = 'Ayarlar';

    /** @var BackedEnum|string|null */
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public ?array $data = [];

    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'settings';
    }

    public function updatedDataPublicLogo(mixed $value): void
    {
        if (is_array($value) && count($value) > 1) {
            $this->data['public_logo'] = array_slice(array_values($value), 0, 1);
        }
    }

    public function updatedDataDashboardLogo(mixed $value): void
    {
        if (is_array($value) && count($value) > 1) {
            $this->data['dashboard_logo'] = array_slice(array_values($value), 0, 1);
        }
    }

    public function updatedDataFavicon(mixed $value): void
    {
        if (is_array($value) && count($value) > 1) {
            $this->data['favicon'] = array_slice(array_values($value), 0, 1);
        }
    }

    public function mount(): void
    {
        $this->data = [
            'site_width' => Setting::get('site_width', 'max-w-7xl'),
            'dashboard_logo' => $this->normalizeFileUploadState(Setting::get('dashboard_logo')),
            'dashboard_logo_width' => Setting::get('dashboard_logo_width', 160),
            'dashboard_logo_height' => Setting::get('dashboard_logo_height', 40),
            'public_logo' => $this->normalizeFileUploadState(Setting::get('public_logo')),
            'public_logo_width' => Setting::get('public_logo_width', 160),
            'public_logo_height' => Setting::get('public_logo_height', 40),
            'favicon' => $this->normalizeFileUploadState(Setting::get('favicon')),
            'favicon_size' => Setting::get('favicon_size', 32),
            'seo_home_title' => Setting::get('seo_home_title'),
            'seo_home_description' => Setting::get('seo_home_description'),
            'seo_home_keywords' => Setting::get('seo_home_keywords'),
            'smtp_host' => Setting::get('smtp_host', ''),
            'smtp_port' => Setting::get('smtp_port', 587),
            'smtp_username' => Setting::get('smtp_username', ''),
            'smtp_password' => Setting::get('smtp_password', ''),
            'smtp_encryption' => Setting::get('smtp_encryption', 'tls'),
            'mail_from_address' => Setting::get('mail_from_address', config('mail.from.address')),
            'mail_from_name' => Setting::get('mail_from_name', config('mail.from.name')),
            'user_panel_name' => Setting::get('user_panel_name', 'Ömer Soft'),
            'user_panel_email' => Setting::get('user_panel_email', 'iletisim@omersoft.com'),
            'user_panel_linkedin' => Setting::get('user_panel_linkedin', 'https://www.linkedin.com/in/omerdesign/'),
            'footer_text' => Setting::get('footer_text', '© {year} {app_name}. All rights reserved.'),
        ];
    }

    /**
     * FileUpload expects array state; DB stores single path as string.
     * Always returns max 1 item to avoid "must not have more than 1 items" validation.
     */
    private function normalizeFileUploadState(mixed $value): array
    {
        if (is_array($value)) {
            return array_slice(array_values($value), 0, 1);
        }
        if (is_string($value) && $value !== '') {
            return [$value];
        }
        return [];
    }

    /**
     * Persist single file path from FileUpload state (array or string).
     */
    private function toSingleFilePath(mixed $value): ?string
    {
        if (is_array($value)) {
            $first = reset($value);
            return $first !== false ? (string) $first : null;
        }
        return $value !== null && $value !== '' ? (string) $value : null;
    }

    private function deleteSettingFileIfChanged(string $key, ?string $newPath): void
    {
        // Artık görseller public/images altında tutulduğu için
        // Laravel'in storage diskinden silme işlemi yapmıyoruz.
        // Yalnızca veritabanındaki path güncelleniyor.
    }

    private function sendTestMail(string $to): void
    {
        $host = Setting::get('smtp_host');
        if (!$host) {
            Notification::make()
                ->title('Önce SMTP ayarlarını kaydedin')
                ->warning()
                ->send();
            return;
        }

        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => $host,
            'port' => (int) (Setting::get('smtp_port') ?? 587),
            'encryption' => Setting::get('smtp_encryption') ?: null,
            'username' => Setting::get('smtp_username') ?: null,
            'password' => Setting::get('smtp_password') ?: null,
            'timeout' => null,
        ]);

        Config::set('mail.from', [
            'address' => Setting::get('mail_from_address') ?? config('mail.from.address'),
            'name' => Setting::get('mail_from_name') ?? config('mail.from.name'),
        ]);

        try {
            Mail::mailer('smtp')->raw('Bu bir test e-postasıdır. SMTP ayarlarınız doğru yapılandırılmış.', function ($message) use ($to) {
                $message->to($to)->subject('SMTP Test Mail');
            });

            Notification::make()
                ->title('Test mail gönderildi')
                ->body($to . ' adresine test e-postası gönderildi.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Mail gönderilemedi')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('Ayarlar')
                    ->tabs([
                        Tab::make('Genel Ayarlar')
                            ->schema([
                                Select::make('site_width')
                                    ->label('Public site genişliği')
                                    ->options([
                                        'max-w-4xl' => 'Dar (896px)',
                                        'max-w-5xl' => 'Orta (1024px)',
                                        'max-w-6xl' => 'Geniş (1152px)',
                                        'max-w-7xl' => 'Çok Geniş (1280px)',
                                        'full' => 'Tam Genişlik',
                                    ])
                                    ->default('max-w-7xl')
                                    ->helperText('Ana sayfa, blog ve yazı sayfalarındaki içerik container genişliği.'),

                                FileUpload::make('dashboard_logo')
                                    ->label('Dashboard logosu')
                                    ->image()
                                    ->imagePreviewHeight('80')
                                    ->disk('public_root')
                                    ->directory('images')
                                    ->maxFiles(1)
                                    ->acceptedFileTypes(['image/*', 'image/svg+xml'])
                                    ->helperText('Yönetim panelinde kullanılacak logo (PNG, JPG, SVG). Dosya yolu public/images altında saklanır.')
                                    ->afterStateUpdated(function (mixed $state): void {
                                        if (is_array($state) && count($state) > 1) {
                                            $this->data['dashboard_logo'] = array_slice(array_values($state), 0, 1);
                                        }
                                    }),

                                TextInput::make('dashboard_logo_width')
                                    ->label('Dashboard logo genişliği (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(512)
                                    ->suffix('px'),

                                TextInput::make('dashboard_logo_height')
                                    ->label('Dashboard logo yüksekliği (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(256)
                                    ->suffix('px'),

                                FileUpload::make('public_logo')
                                    ->label('Public site logosu')
                                    ->image()
                                    ->imagePreviewHeight('80')
                                    ->disk('public_root')
                                    ->directory('images')
                                    ->maxFiles(1)
                                    ->acceptedFileTypes(['image/*', 'image/svg+xml'])
                                    ->helperText('Public sitede (header/footer) kullanılacak logo (PNG, JPG, SVG). Dosya yolu public/images altında saklanır.')
                                    ->afterStateUpdated(function (mixed $state): void {
                                        if (is_array($state) && count($state) > 1) {
                                            $this->data['public_logo'] = array_slice(array_values($state), 0, 1);
                                        }
                                    }),

                                TextInput::make('public_logo_width')
                                    ->label('Public logo genişliği (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(512)
                                    ->suffix('px'),

                                TextInput::make('public_logo_height')
                                    ->label('Public logo yüksekliği (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(256)
                                    ->suffix('px'),

                                FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->imagePreviewHeight('40')
                                    ->disk('public_root')
                                    ->directory('images')
                                    ->maxFiles(1)
                                    ->acceptedFileTypes(['image/*', 'image/svg+xml', 'image/x-icon'])
                                    ->helperText('Tarayıcı sekmesinde görünecek ikon (PNG, JPG, SVG, ICO). Dosya yolu public/images altında saklanır.')
                                    ->afterStateUpdated(function (mixed $state): void {
                                        if (is_array($state) && count($state) > 1) {
                                            $this->data['favicon'] = array_slice(array_values($state), 0, 1);
                                        }
                                    }),

                                TextInput::make('favicon_size')
                                    ->label('Favicon boyutu (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(256)
                                    ->suffix('px'),

                                TextInput::make('user_panel_name')
                                    ->label('Profil Adı (Header panel)')
                                    ->placeholder('Ömer Soft')
                                    ->helperText('Sağ üst menü panelinde görünecek profil adı.'),

                                TextInput::make('user_panel_email')
                                    ->label('Profil E-posta')
                                    ->email()
                                    ->placeholder('iletisim@omersoft.com')
                                    ->helperText('Sağ üst menü panelinde görünecek e-posta adresi.'),

                                TextInput::make('user_panel_linkedin')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->placeholder('https://www.linkedin.com/in/omerdesign/')
                                    ->helperText('Profil panelinde görünecek LinkedIn bağlantısı.'),

                                Textarea::make('footer_text')
                                    ->label('Footer metni')
                                    ->rows(2)
                                    ->placeholder('© {year} {app_name}. All rights reserved.')
                                    ->helperText('Sayfa altında görünecek tam footer metni. {year} ve {app_name} otomatik değiştirilir.'),
                            ]),

                        Tab::make('SEO')
                            ->schema([
                                TextInput::make('seo_home_title')
                                    ->label('Anasayfa Title')
                                    ->maxLength(255)
                                    ->helperText('Tarayıcı sekmesinde ve arama sonuçlarında gösterilecek başlık.'),

                                Textarea::make('seo_home_description')
                                    ->label('Anasayfa Description')
                                    ->rows(4)
                                    ->maxLength(500)
                                    ->helperText('Arama motoru snippet\'i için kısa açıklama.'),

                                TextInput::make('seo_home_keywords')
                                    ->label('Anasayfa Keywords')
                                    ->helperText('Virgülle ayrılmış anahtar kelimeler (opsiyonel).'),
                            ]),

                        Tab::make('SMTP Ayarları')
                            ->schema([
                                TextInput::make('smtp_host')
                                    ->label('SMTP Host')
                                    ->placeholder('smtp.example.com'),
                                TextInput::make('smtp_port')
                                    ->label('SMTP Port')
                                    ->numeric()
                                    ->default(587)
                                    ->placeholder('587'),
                                TextInput::make('smtp_username')
                                    ->label('SMTP Kullanıcı Adı')
                                    ->placeholder('user@example.com'),
                                TextInput::make('smtp_password')
                                    ->label('SMTP Şifre')
                                    ->password()
                                    ->placeholder('••••••••'),
                                Select::make('smtp_encryption')
                                    ->label('Şifreleme')
                                    ->options([
                                        'tls' => 'TLS',
                                        'ssl' => 'SSL',
                                        '' => 'Yok',
                                    ])
                                    ->default('tls'),
                                TextInput::make('mail_from_address')
                                    ->label('Gönderen E-posta')
                                    ->email()
                                    ->placeholder('noreply@example.com'),
                                TextInput::make('mail_from_name')
                                    ->label('Gönderen Adı')
                                    ->placeholder('Site Adı'),
                            ]),
                    ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->statePath('data')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('testMail')
                                ->label('Test Mail Gönder')
                                ->color('gray')
                                ->icon('heroicon-o-paper-airplane')
                                ->form([
                                    \Filament\Forms\Components\TextInput::make('test_email')
                                        ->label('Test e-posta adresi')
                                        ->email()
                                        ->required()
                                        ->placeholder('test@example.com'),
                                ])
                                ->action(function (array $data): void {
                                    $this->sendTestMail($data['test_email']);
                                }),
                            Action::make('save')
                                ->label('Kaydet')
                                ->submit('form'),
                        ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->getSchema('form')->getState();

        Setting::set('site_width', $data['site_width'] ?? 'max-w-7xl');

        $dashboardLogoRaw = $data['dashboard_logo'] ?? null;
        $dashboardLogo = $this->toSingleFilePath(is_array($dashboardLogoRaw) ? array_slice($dashboardLogoRaw, 0, 1) : $dashboardLogoRaw);
        $this->deleteSettingFileIfChanged('dashboard_logo', $dashboardLogo);
        Setting::set('dashboard_logo', $dashboardLogo);

        Setting::set('dashboard_logo_width', $data['dashboard_logo_width'] ?? 160);
        Setting::set('dashboard_logo_height', $data['dashboard_logo_height'] ?? 40);

        $publicLogoRaw = $data['public_logo'] ?? null;
        $publicLogo = $this->toSingleFilePath(is_array($publicLogoRaw) ? array_slice($publicLogoRaw, 0, 1) : $publicLogoRaw);
        $this->deleteSettingFileIfChanged('public_logo', $publicLogo);
        Setting::set('public_logo', $publicLogo);

        Setting::set('public_logo_width', $data['public_logo_width'] ?? 160);
        Setting::set('public_logo_height', $data['public_logo_height'] ?? 40);

        $faviconRaw = $data['favicon'] ?? null;
        $favicon = $this->toSingleFilePath(is_array($faviconRaw) ? array_slice($faviconRaw, 0, 1) : $faviconRaw);
        $this->deleteSettingFileIfChanged('favicon', $favicon);
        Setting::set('favicon', $favicon);

        Setting::set('favicon_size', $data['favicon_size'] ?? 32);
        Setting::set('seo_home_title', $data['seo_home_title'] ?? null);
        Setting::set('seo_home_description', $data['seo_home_description'] ?? null);
        Setting::set('seo_home_keywords', $data['seo_home_keywords'] ?? null);

        Setting::set('user_panel_name', $data['user_panel_name'] ?? 'Ömer Soft');
        Setting::set('user_panel_email', $data['user_panel_email'] ?? '');
        Setting::set('user_panel_linkedin', $data['user_panel_linkedin'] ?? '');
        Setting::set('footer_text', $data['footer_text'] ?? '© {year} {app_name}. All rights reserved.');

        Setting::set('smtp_host', $data['smtp_host'] ?? '');
        Setting::set('smtp_port', $data['smtp_port'] ?? 587);
        Setting::set('smtp_username', $data['smtp_username'] ?? '');
        Setting::set('smtp_password', $data['smtp_password'] ?? '');
        Setting::set('smtp_encryption', $data['smtp_encryption'] ?? 'tls');
        Setting::set('mail_from_address', $data['mail_from_address'] ?? null);
        Setting::set('mail_from_name', $data['mail_from_name'] ?? null);

        Notification::make()
            ->title('Ayarlar kaydedildi')
            ->success()
            ->send();
    }
}

