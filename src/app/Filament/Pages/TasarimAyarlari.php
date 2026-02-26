<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class TasarimAyarlari extends \Filament\Pages\Page
{

    protected static ?string $navigationLabel = 'Tasarım Ayarları';

    protected static ?string $title = 'Tasarım Ayarları';

    public ?array $data = [];

    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'tasarim-ayarlari';
    }

    public function mount(): void
    {
        $this->data = [
            'site_width' => Setting::get('site_width', 'max-w-7xl'),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('Ayarlar')
                    ->tabs([
                        Tab::make('Site Tasarımı')
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

        Notification::make()
            ->title('Ayarlar kaydedildi')
            ->success()
            ->send();
    }
}
