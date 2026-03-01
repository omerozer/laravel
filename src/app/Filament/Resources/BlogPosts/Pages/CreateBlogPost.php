<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\BlogPost;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Sadece fillable alanları geçir (ekstra anahtarlar hata verebilir)
        $model = new BlogPost;
        $fillable = array_flip($model->getFillable());
        $filtered = array_intersect_key($data, $fillable);

        return parent::handleRecordCreation($filtered);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = $data['user_id'] ?? auth()->id();

        // blog_category_id boş string → null (nullable FK)
        if (array_key_exists('blog_category_id') && $data['blog_category_id'] === '') {
            $data['blog_category_id'] = null;
        }

        // Slug benzersizliği: varsa -1, -2 ... ekle
        $slug = $data['slug'] ?? \Illuminate\Support\Str::slug($data['title'] ?? '');
        if ($slug && BlogPost::where('slug', $slug)->exists()) {
            $base = $slug;
            $n = 1;
            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $n++;
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
