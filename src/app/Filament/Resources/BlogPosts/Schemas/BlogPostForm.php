<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Models\BlogCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Yazı')
                    ->schema([
                        TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->maxLength(255)
                            ->helperText('Boş bırakılırsa başlıktan otomatik oluşturulur'),
                        Textarea::make('excerpt')
                            ->label('Özet')
                            ->rows(2)
                            ->columnSpanFull(),
                        \Filament\Forms\Components\RichEditor::make('content')
                            ->label('İçerik')
                            ->required()
                            ->columnSpanFull()
                            ->extraInputAttributes(['style' => 'min-height: 20rem;'])
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'codeBlock',
                                'table',
                            ])
                            ->resizableImages(),
                        Select::make('blog_category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->label('Durum')
                            ->options([
                                'draft' => 'Taslak (sitede görünmez)',
                                'published' => 'Yayında',
                            ])
                            ->default('published')
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->label('Yayın Tarihi')
                            ->nullable()
                            ->helperText('Yayında seçiliyse ve boş bırakılırsa şimdi kullanılır. Gelecek tarih seçerseniz post o zamana kadar sitede görünmez.'),
                        FileUpload::make('image')
                            ->label('Görsel')
                            ->image()
                            ->directory('blog')
                            ->disk('public')
                            ->nullable(),
                        TextInput::make('meta_title')
                            ->label('Meta Başlık (SEO)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('meta_description')
                            ->label('Meta Açıklama (SEO)')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }
}
