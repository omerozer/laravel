<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Illuminate\Support\Facades\Storage;
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
        return 'tasarim-ayarlari';
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
        ];
    }

    /**
     * FileUpload expects array state; DB stores single path as string.
     */
    private function normalizeFileUploadState(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }
        return $value ? [$value] : [];
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
                                    ->helperText('Yönetim panelinde kullanılacak logo (PNG, JPG, SVG). Dosya yolu public/images altında saklanır.'),

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
                                    ->helperText('Public sitede (header/footer) kullanılacak logo (PNG, JPG, SVG). Dosya yolu public/images altında saklanır.'),

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
                                    ->helperText('Tarayıcı sekmesinde görünecek ikon (PNG, JPG, SVG, ICO). Dosya yolu public/images altında saklanır.'),

                                TextInput::make('favicon_size')
                                    ->label('Favicon boyutu (px)')
                                    ->numeric()
                                    ->minValue(16)
                                    ->maxValue(256)
                                    ->suffix('px'),
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

        $dashboardLogo = $this->toSingleFilePath($data['dashboard_logo'] ?? null);
        $this->deleteSettingFileIfChanged('dashboard_logo', $dashboardLogo);
        Setting::set('dashboard_logo', $dashboardLogo);

        Setting::set('dashboard_logo_width', $data['dashboard_logo_width'] ?? 160);
        Setting::set('dashboard_logo_height', $data['dashboard_logo_height'] ?? 40);

        $publicLogo = $this->toSingleFilePath($data['public_logo'] ?? null);
        $this->deleteSettingFileIfChanged('public_logo', $publicLogo);
        Setting::set('public_logo', $publicLogo);

        Setting::set('public_logo_width', $data['public_logo_width'] ?? 160);
        Setting::set('public_logo_height', $data['public_logo_height'] ?? 40);

        $favicon = $this->toSingleFilePath($data['favicon'] ?? null);
        $this->deleteSettingFileIfChanged('favicon', $favicon);
        Setting::set('favicon', $favicon);

        Setting::set('favicon_size', $data['favicon_size'] ?? 32);
        Setting::set('seo_home_title', $data['seo_home_title'] ?? null);
        Setting::set('seo_home_description', $data['seo_home_description'] ?? null);
        Setting::set('seo_home_keywords', $data['seo_home_keywords'] ?? null);

        Notification::make()
            ->title('Ayarlar kaydedildi')
            ->success()
            ->send();
    }
}

