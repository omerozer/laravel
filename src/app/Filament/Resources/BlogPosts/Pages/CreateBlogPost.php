<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = $data['user_id'] ?? auth()->id();

        // Yayında + tarih boşsa şimdiye ayarla (DateTimePicker boş bırakıldığında)
        if (($data['status'] ?? '') === 'published' && blank($data['published_at'] ?? null)) {
            $data['published_at'] = now();
        }

        // Boş string → null (model cast uyumu)
        if (isset($data['published_at']) && $data['published_at'] === '') {
            $data['published_at'] = null;
        }

        return $data;
    }
}
