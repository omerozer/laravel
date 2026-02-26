<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ImportOmersoftBlogCommand extends Command
{
    protected $signature = 'blog:import-omersoft';

    protected $description = 'Import blog posts from omersoft.com/blog and /blog?page=2 into database/data/omersoft-posts.json';

    private const BASE_URL = 'https://omersoft.com';

    public function handle(): int
    {
        $this->info('Fetching blog list pages...');

        $posts = [];

        foreach (['/blog', '/blog?page=2'] as $path) {
            $response = Http::timeout(30)->get(self::BASE_URL . $path);

            if (! $response->successful()) {
                $this->error("Failed to fetch {$path}: HTTP {$response->status()}");
                continue;
            }

            $crawler = new Crawler($response->body());

            $crawler->filter('a[href*="/post/"]')->each(function (Crawler $link) use (&$posts) {
                $href = $link->attr('href');
                if (! $href) {
                    return;
                }

                $slug = $this->extractSlugFromUrl($href);
                if (! $slug || isset($posts[$slug])) {
                    return;
                }

                $row = $link->getNode(0)?->parentNode?->parentNode;
                $categoryName = null;
                if ($row) {
                    $rowCrawler = new Crawler($row);
                    $categoryLink = $rowCrawler->filter('a[href*="/category/"]')->first();
                    if ($categoryLink->count() > 0) {
                        $categoryName = trim($categoryLink->text());
                    }
                }

                if (! $categoryName) {
                    $categoryName = 'Web Yazılım';
                }

                $posts[$slug] = [
                    'title' => trim($link->text()),
                    'slug' => $slug,
                    'category_name' => $categoryName,
                    'content' => null,
                    'excerpt' => null,
                ];
            });
        }

        $posts = array_values($posts);
        $total = count($posts);
        $this->info("Found {$total} unique posts. Fetching content...");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($posts as $i => &$post) {
            $content = $this->fetchPostContent($post['slug']);
            $post['content'] = $content['content'];
            $post['excerpt'] = $content['excerpt'] ?? \Illuminate\Support\Str::limit(strip_tags($content['content']), 200);
            $post['title'] = $content['title'] ?? $post['title'];
            $post['category_name'] = $content['category_name'] ?? $post['category_name'];
            $bar->advance();

            usleep(300000);
        }

        $bar->finish();
        $this->newLine();

        $dataDir = database_path('data');
        if (! is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }

        $path = $dataDir . '/omersoft-posts.json';
        file_put_contents($path, json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $this->info("Saved {$total} posts to {$path}");

        return self::SUCCESS;
    }

    private function extractSlugFromUrl(string $url): ?string
    {
        $parsed = parse_url($url);
        $path = $parsed['path'] ?? '';

        if (preg_match('#/post/(.+)#', $path, $m)) {
            return trim($m[1], '/');
        }

        return null;
    }

    private function fetchPostContent(string $slug): array
    {
        $response = Http::timeout(30)->get(self::BASE_URL . '/post/' . $slug);

        if (! $response->successful()) {
            return ['content' => '', 'excerpt' => null, 'title' => null, 'category_name' => null];
        }

        $crawler = new Crawler($response->body());

        $title = null;
        $h1 = $crawler->filter('h1')->first();
        if ($h1->count() > 0) {
            $title = trim($h1->text());
        }

        $categoryName = null;
        $catLink = $crawler->filter('a[href*="/category/"]')->first();
        if ($catLink->count() > 0) {
            $categoryName = trim($catLink->text());
        }

        $content = '';
        // Sadece asıl içerik (prose div) - kategori badge, h1, meta bilgisi HARİÇ
        $contentSelectors = ['div.prose', '.prose', 'main .prose div.prose', 'article .prose'];
        foreach ($contentSelectors as $selector) {
            try {
                $node = $crawler->filter($selector)->first();
                if ($node->count() > 0) {
                    $content = $node->html();
                    break;
                }
            } catch (\Throwable) {
                continue;
            }
        }

        if (empty($content)) {
            $contentSelectorsFallback = ['article', 'main article', '.post-content', '.content', 'main'];
            foreach ($contentSelectorsFallback as $selector) {
                try {
                    $node = $crawler->filter($selector)->first();
                    if ($node->count() > 0) {
                        $html = $node->html();
                        $inner = new Crawler($html);
                        $prose = $inner->filter('.prose')->first();
                        if ($prose->count() > 0) {
                            $content = $prose->html();
                        } else {
                            $content = $html;
                        }
                        break;
                    }
                } catch (\Throwable) {
                    continue;
                }
            }
        }

        $excerpt = \Illuminate\Support\Str::limit(strip_tags($content), 200);

        return [
            'content' => $content,
            'excerpt' => $excerpt,
            'title' => $title,
            'category_name' => $categoryName,
        ];
    }
}
