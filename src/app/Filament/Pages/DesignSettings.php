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
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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

    public function mount(): void
    {
            $this->data = [
            'site_name' => Setting::get('site_name', config('app.name')),
            'site_width' => Setting::get('site_width', 'max-w-7xl'),
            'hero_title_1_en' => Setting::get('hero_title_1_en', 'Software That Runs Your'),
            'hero_title_1_tr' => Setting::get('hero_title_1_tr', 'İşlerinizi Yöneten'),
            'hero_title_2_en' => Setting::get('hero_title_2_en', 'Operations'),
            'hero_title_2_tr' => Setting::get('hero_title_2_tr', 'Özel Yazılımlar'),
            'hero_subtitle_en' => Setting::get('hero_subtitle_en', 'I build internal systems that automate daily work and keep your operations running without constant supervision.'),
            'hero_subtitle_tr' => Setting::get('hero_subtitle_tr', 'İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan özel sistemler tasarlıyorum.'),
            'hero_title_size' => Setting::get('hero_title_size', 'md'),
            'hero_subtitle_size' => Setting::get('hero_subtitle_size', 'md'),
            'hero_avatar' => $this->normalizeFileUploadState(Setting::get('hero_avatar', 'images/omer.jpeg')),
            'dashboard_logo' => $this->normalizeFileUploadState(Setting::get('dashboard_logo')),
            'dashboard_logo_height' => Setting::get('dashboard_logo_height', 40),
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
            'social_linkedin' => Setting::get('social_linkedin') ?: Setting::get('user_panel_linkedin', 'https://www.linkedin.com/in/omerdesign/'),
            'social_behance' => Setting::get('social_behance', ''),
            'social_github' => Setting::get('social_github', ''),
        ];
    }

    /**
     * FileUpload expects array state; DB stores single path as string.
     * public_root disk: path "images/xxx", asset() works, .htaccess serves /images/ from public/images/.
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
     * public_root disk: files in public/images/, path "images/xxx" for asset() - .htaccess serves /images/.
     */
    private function toSingleFilePath(mixed $value): ?string
    {
        $item = null;
        if (is_array($value)) {
            $first = reset($value);
            $item = $first !== false ? $first : null;
        } else {
            $item = $value;
        }

        if ($item instanceof TemporaryUploadedFile) {
            $path = $item->store('images', ['disk' => 'public_root']);
            return $path !== false ? $path : null;
        }
        if (is_string($item) && $item !== '') {
            return $item;
        }
        return $item !== null && $item !== '' ? (string) $item : null;
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
                                Section::make('Site')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Site adı')
                                            ->placeholder(config('app.name'))
                                            ->maxLength(255)
                                            ->helperText('Header ve footer\'da görünen site adı.'),

                                        Select::make('site_width')
                                            ->label('Site genişliği')
                                            ->options([
                                                'max-w-4xl' => 'Dar (896px)',
                                                'max-w-5xl' => 'Orta (1024px)',
                                                'max-w-6xl' => 'Geniş (1152px)',
                                                'max-w-7xl' => 'Çok Geniş (1280px)',
                                                'full' => 'Tam Genişlik',
                                            ])
                                            ->default('max-w-7xl')
                                            ->helperText('İçerik container genişliği.'),
                                    ])
                                    ->columns(2),

                                Section::make('Hero (Anasayfa)')
                                    ->schema([
                                        FileUpload::make('hero_avatar')
                                            ->label('Profil görseli')
                                            ->image()
                                            ->imagePreviewHeight('120')
                                            ->disk('public_root')
                                            ->directory('images')
                                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                                            ->fetchFileInformation(false)
                                            ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file): ?string => $file->store('images', ['disk' => 'public_root']) ?: null)
                                            ->helperText('Anasayfa hero bölümündeki profil fotoğrafı.'),

                                        TextInput::make('hero_title_1_en')
                                            ->label('Başlık 1 (İngilizce)')
                                            ->placeholder('Software That Runs Your')
                                            ->maxLength(100),

                                        TextInput::make('hero_title_1_tr')
                                            ->label('Başlık 1 (Türkçe)')
                                            ->placeholder('İşlerinizi Yöneten')
                                            ->maxLength(100),

                                        TextInput::make('hero_title_2_en')
                                            ->label('Başlık 2 (İngilizce)')
                                            ->placeholder('Operations')
                                            ->maxLength(100),

                                        TextInput::make('hero_title_2_tr')
                                            ->label('Başlık 2 (Türkçe)')
                                            ->placeholder('Özel Yazılımlar')
                                            ->maxLength(100),

                                        Textarea::make('hero_subtitle_en')
                                            ->label('Alt başlık (İngilizce)')
                                            ->rows(3)
                                            ->placeholder('I build internal systems...')
                                            ->maxLength(500)
                                            ->helperText('Satır kırmak için <br> kullanabilirsiniz.'),

                                        Textarea::make('hero_subtitle_tr')
                                            ->label('Alt başlık (Türkçe)')
                                            ->rows(3)
                                            ->placeholder('İşlerin kişilere bağlı kalmadan düzenli ilerlemesini sağlayan<br> özel sistemler tasarlıyorum.')
                                            ->maxLength(500)
                                            ->helperText('Satır kırmak için <br> kullanabilirsiniz.'),

                                        Select::make('hero_title_size')
                                            ->label('Başlık boyutu')
                                            ->options([
                                                'sm' => 'Küçük',
                                                'md' => 'Orta (varsayılan)',
                                                'lg' => 'Büyük',
                                                'xl' => 'Çok Büyük',
                                            ])
                                            ->default('md')
                                            ->helperText('Ana başlık font boyutu.'),

                                        Select::make('hero_subtitle_size')
                                            ->label('Açıklama boyutu')
                                            ->options([
                                                'sm' => 'Küçük',
                                                'md' => 'Orta (varsayılan)',
                                                'lg' => 'Büyük',
                                            ])
                                            ->default('md')
                                            ->helperText('Alt başlık / açıklama font boyutu.'),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),

                                Section::make('Logolar')
                                    ->schema([
                                        FileUpload::make('dashboard_logo')
                                            ->label('Dashboard logosu')
                                            ->image()
                                            ->imagePreviewHeight('80')
                                            ->disk('public_root')
                                            ->directory('images')
                                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
                                            ->fetchFileInformation(false)
                                            ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file): ?string => $file->store('images', ['disk' => 'public_root']) ?: null)
                                            ->helperText('Panel login ve header logosu.'),

                                        TextInput::make('dashboard_logo_height')
                                            ->label('Logo yüksekliği (px)')
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
                                            ->acceptedFileTypes(['image/*', 'image/svg+xml', 'image/webp', 'image/x-icon'])
                                            ->fetchFileInformation(false)
                                            ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file): ?string => $file->store('images', ['disk' => 'public_root']) ?: null)
                                            ->helperText('Tarayıcı sekmesinde görünecek ikon.'),

                                        TextInput::make('favicon_size')
                                            ->label('Favicon boyutu (px)')
                                            ->numeric()
                                            ->minValue(16)
                                            ->maxValue(256)
                                            ->suffix('px'),
                                    ])
                                    ->columns(2),

                                Section::make('Profil')
                                    ->schema([
                                        TextInput::make('user_panel_name')
                                            ->label('Profil adı')
                                            ->placeholder('Ömer Soft')
                                            ->helperText('Sağ üst menü panelinde.'),

                                        TextInput::make('user_panel_email')
                                            ->label('Profil e-posta')
                                            ->email()
                                            ->placeholder('iletisim@omersoft.com'),

                                        TextInput::make('user_panel_linkedin')
                                            ->label('LinkedIn URL')
                                            ->url()
                                            ->placeholder('https://www.linkedin.com/in/omerdesign/'),
                                    ])
                                    ->columns(2),

                                Section::make('Footer')
                                    ->schema([
                                        Textarea::make('footer_text')
                                            ->label('Footer metni')
                                            ->rows(2)
                                            ->placeholder('© {year} {app_name}. All rights reserved.')
                                            ->helperText('{year} ve {app_name} otomatik değiştirilir.'),

                                        TextInput::make('social_linkedin')
                                            ->label('LinkedIn URL (footer)')
                                            ->url()
                                            ->placeholder('https://www.linkedin.com/in/...'),
                                        TextInput::make('social_behance')
                                            ->label('Behance URL')
                                            ->url()
                                            ->placeholder('https://www.behance.net/...'),
                                        TextInput::make('social_github')
                                            ->label('GitHub URL')
                                            ->url()
                                            ->placeholder('https://github.com/...'),
                                    ])
                                    ->columns(1),
                            ]),

                        Tab::make('SEO')
                            ->schema([
                                Section::make('Anasayfa SEO')
                                    ->schema([
                                        TextInput::make('seo_home_title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->helperText('Tarayıcı sekmesinde ve arama sonuçlarında.'),

                                        TextInput::make('seo_home_keywords')
                                            ->label('Keywords')
                                            ->helperText('Virgülle ayrılmış anahtar kelimeler.'),

                                        Textarea::make('seo_home_description')
                                            ->label('Description')
                                            ->rows(4)
                                            ->maxLength(500)
                                            ->helperText('Arama motoru snippet\'i için kısa açıklama.'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('SMTP Ayarları')
                            ->schema([
                                Section::make('SMTP Sunucu')
                                    ->schema([
                                        TextInput::make('smtp_host')
                                            ->label('Host')
                                            ->placeholder('smtp.example.com'),
                                        TextInput::make('smtp_port')
                                            ->label('Port')
                                            ->numeric()
                                            ->default(587)
                                            ->placeholder('587'),
                                        TextInput::make('smtp_username')
                                            ->label('Kullanıcı Adı')
                                            ->placeholder('user@example.com'),
                                        TextInput::make('smtp_password')
                                            ->label('Şifre')
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
                                    ])
                                    ->columns(2),

                                Section::make('Gönderen Bilgileri')
                                    ->schema([
                                        TextInput::make('mail_from_address')
                                            ->label('E-posta')
                                            ->email()
                                            ->placeholder('noreply@example.com'),
                                        TextInput::make('mail_from_name')
                                            ->label('Ad')
                                            ->placeholder('Site Adı'),
                                    ])
                                    ->columns(2),
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

        Setting::set('site_name', $data['site_name'] ?? config('app.name'));
        Setting::set('site_width', $data['site_width'] ?? 'max-w-7xl');

        $heroAvatarRaw = $this->data['hero_avatar'] ?? $data['hero_avatar'] ?? null;
        $heroAvatar = $this->toSingleFilePath(is_array($heroAvatarRaw) ? array_slice($heroAvatarRaw, 0, 1) : $heroAvatarRaw);
        if ($heroAvatar !== null && $heroAvatar !== '') {
            Setting::set('hero_avatar', $heroAvatar);
        }

        Setting::set('hero_title_1_en', $data['hero_title_1_en'] ?? 'Software That Runs Your');
        Setting::set('hero_title_1_tr', $data['hero_title_1_tr'] ?? 'İşlerinizi Yöneten');
        Setting::set('hero_title_2_en', $data['hero_title_2_en'] ?? 'Operations');
        Setting::set('hero_title_2_tr', $data['hero_title_2_tr'] ?? 'Özel Yazılımlar');
        Setting::set('hero_subtitle_en', $data['hero_subtitle_en'] ?? '');
        Setting::set('hero_subtitle_tr', $data['hero_subtitle_tr'] ?? '');
        Setting::set('hero_title_size', $data['hero_title_size'] ?? 'md');
        Setting::set('hero_subtitle_size', $data['hero_subtitle_size'] ?? 'md');

        // FileUpload state - use $this->data (Livewire) as getState() may not include file paths
        $dashboardLogoRaw = $this->data['dashboard_logo'] ?? $data['dashboard_logo'] ?? null;
        $dashboardLogo = $this->toSingleFilePath(is_array($dashboardLogoRaw) ? array_slice($dashboardLogoRaw, 0, 1) : $dashboardLogoRaw);
        $dashboardLogoToSave = ($dashboardLogo !== null && $dashboardLogo !== '') ? $dashboardLogo : Setting::get('dashboard_logo');
        if ($dashboardLogoToSave !== null && $dashboardLogoToSave !== '') {
            Setting::set('dashboard_logo', $dashboardLogoToSave);
        }

        Setting::set('dashboard_logo_height', $data['dashboard_logo_height'] ?? 40);

        $faviconRaw = $this->data['favicon'] ?? $data['favicon'] ?? null;
        $favicon = $this->toSingleFilePath(is_array($faviconRaw) ? array_slice($faviconRaw, 0, 1) : $faviconRaw);
        $faviconToSave = ($favicon !== null && $favicon !== '') ? $favicon : Setting::get('favicon');
        if ($faviconToSave !== null && $faviconToSave !== '') {
            Setting::set('favicon', $faviconToSave);
        }

        Setting::set('favicon_size', $data['favicon_size'] ?? 32);
        Setting::set('seo_home_title', $data['seo_home_title'] ?? null);
        Setting::set('seo_home_description', $data['seo_home_description'] ?? null);
        Setting::set('seo_home_keywords', $data['seo_home_keywords'] ?? null);

        Setting::set('user_panel_name', $data['user_panel_name'] ?? 'Ömer Soft');
        Setting::set('user_panel_email', $data['user_panel_email'] ?? '');
        Setting::set('user_panel_linkedin', $data['user_panel_linkedin'] ?? '');
        Setting::set('footer_text', $data['footer_text'] ?? '© {year} {app_name}. All rights reserved.');
        Setting::set('social_linkedin', $data['social_linkedin'] ?? '');
        Setting::set('social_behance', $data['social_behance'] ?? '');
        Setting::set('social_github', $data['social_github'] ?? '');

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

