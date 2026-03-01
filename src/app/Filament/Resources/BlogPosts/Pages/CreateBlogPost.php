<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\BlogPost;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = $data['user_id'] ?? auth()->id();

        // blog_category_id boş string → null (nullable FK)
        if (array_key_exists('blog_category_id') && $data['blog_category_id'] === '') {
            $data['blog_category_id'] = null;
        }

        // Slug: boşsa başlıktan oluştur, varsa benzersiz yap
        $slug = !empty(trim($data['slug'] ?? '')) ? trim($data['slug']) : \Illuminate\Support\Str::slug($data['title'] ?? '');
        if ($slug) {
            if (BlogPost::where('slug', $slug)->exists()) {
                $base = $slug;
                $n = 1;
                while (BlogPost::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $n++;
                }
            }
            $data['slug'] = $slug;
        }

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
