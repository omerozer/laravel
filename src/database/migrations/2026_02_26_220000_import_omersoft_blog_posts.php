<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $path = database_path('data/omersoft-posts.json');

        if (! file_exists($path)) {
            return;
        }

        $json = file_get_contents($path);
        $posts = json_decode($json, true);

        if (! is_array($posts) || empty($posts)) {
            return;
        }

        $user = User::first();
        if (! $user) {
            throw new \RuntimeException('En az bir kullanıcı olmalıdır. Önce php artisan db:seed çalıştırın.');
        }

        foreach ($posts as $item) {
            $categoryName = $item['category_name'] ?? 'Web Yazılım';
            $category = BlogCategory::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );

            BlogPost::updateOrCreate(
                ['slug' => $item['slug'] ?? Str::slug($item['title'] ?? '')],
                [
                    'user_id' => $user->id,
                    'blog_category_id' => $category->id,
                    'title' => $item['title'] ?? 'Başlıksız',
                    'slug' => $item['slug'] ?? Str::slug($item['title'] ?? 'basliksiz'),
                    'excerpt' => $item['excerpt'] ?? Str::limit(strip_tags($item['content'] ?? ''), 200),
                    'content' => $item['content'] ?? '',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $path = database_path('data/omersoft-posts.json');

        if (! file_exists($path)) {
            return;
        }

        $json = file_get_contents($path);
        $posts = json_decode($json, true);

        if (! is_array($posts)) {
            return;
        }

        foreach ($posts as $item) {
            $slug = $item['slug'] ?? Str::slug($item['title'] ?? '');
            if ($slug) {
                BlogPost::where('slug', $slug)->delete();
            }
        }
    }
};
