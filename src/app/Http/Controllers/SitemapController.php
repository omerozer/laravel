<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $urls = collect();

        // Ana sayfa
        $urls->push([
            'loc' => $baseUrl . '/',
            'lastmod' => now()->toIso8601String(),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ]);

        // Blog index
        $blogLastmod = BlogPost::query()->max('updated_at');
        $urls->push([
            'loc' => $baseUrl . '/blog',
            'lastmod' => $blogLastmod ? \Carbon\Carbon::parse($blogLastmod)->toIso8601String() : now()->toIso8601String(),
            'changefreq' => 'daily',
            'priority' => '0.9',
        ]);

        // Blog yazıları
        $posts = BlogPost::query()
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at']);

        foreach ($posts as $post) {
            $urls->push([
                'loc' => $baseUrl . '/post/' . $post->slug,
                'lastmod' => $post->updated_at->toIso8601String(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);
        }

        // Kategoriler
        $categories = BlogCategory::query()
            ->whereHas('posts', fn ($q) => $q->where('status', 'published'))
            ->orderBy('name')
            ->get();

        foreach ($categories as $category) {
            $lastmod = $category->posts()->where('status', 'published')->max('updated_at');
            $urls->push([
                'loc' => $baseUrl . '/blog/kategori/' . $category->slug,
                'lastmod' => $lastmod ? \Carbon\Carbon::parse($lastmod)->toIso8601String() : now()->toIso8601String(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]);
        }

        $xml = view('sitemap', [
            'urls' => $urls->toArray(),
        ])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
