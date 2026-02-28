<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = User::first();
        if (! $user) {
            return;
        }

        $category = BlogCategory::firstOrCreate(
            ['slug' => 'web-yazilim'],
            ['name' => 'Web Yazılım']
        );

        $title = 'Laravel Backend\'e En Uygun Frontend Framework\'ler';
        $slug = 'laravel-backend-frontend-frameworkler';

        $content = <<<'HTML'
<h2 id="laravel-frontend">Laravel ve Frontend: Neden Önemli?</h2>

<p>Laravel, PHP ekosisteminin en popüler backend framework'üdür. Ancak modern web uygulamaları sadece API veya Blade ile yetinmez; kullanıcı deneyimi için güçlü bir frontend katmanı gerektirir. Laravel ile birlikte kullanılabilecek birçok frontend yaklaşımı vardır ve doğru seçim, projenizin ölçeği, ekibinizin yetenekleri ve gereksinimlerinize bağlıdır.</p>

<h2 id="uyumlu-frameworkler">Laravel ile Uyumlu Frontend Framework'ler</h2>

<p>Laravel ekosisteminde en yaygın kullanılan frontend seçenekleri şunlardır:</p>

<p><strong>Inertia.js:</strong> Laravel ve Vue/React arasında köprü görevi görür. SPA hissi verirken server-side routing kullanır. Blade benzeri basitlikle modern framework gücünü birleştirir.</p>

<p><strong>Livewire:</strong> Tamamen Laravel içinde çalışır, JavaScript yazmadan dinamik arayüzler oluşturmanızı sağlar. Alpine.js ile birlikte kullanılabilir.</p>

<p><strong>Vue.js + API:</strong> Laravel API ile Vue.js SPA oluşturur. Tam ayrım, bağımsız deployment ve ölçeklenebilirlik sunar.</p>

<p><strong>React + API:</strong> Benzer şekilde Laravel REST API veya GraphQL ile React uygulaması beslenir. Büyük ekipler ve karmaşık state yönetimi için uygundur.</p>

<h2 id="mimarisi">Mimari ve Veri Akışı</h2>

<p>Aşağıdaki diyagram, Laravel backend ile farklı frontend yaklaşımlarının nasıl etkileşime girdiğini gösterir:</p>

<figure class="my-8 rounded-xl overflow-hidden border border-gray-200 dark:border-white/10 bg-white/50 dark:bg-white/5 p-4 sm:p-6">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 480" class="w-full max-w-3xl mx-auto" style="max-height: 400px;">
  <defs>
    <marker id="arrow" markerWidth="8" markerHeight="8" refX="4" refY="4" orient="auto">
      <polygon points="0 0, 8 4, 0 8" fill="#94a3b8"/>
    </marker>
    <linearGradient id="laravelGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#FF2D20"/>
      <stop offset="100%" style="stop-color:#E74C3C"/>
    </linearGradient>
    <linearGradient id="reactGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#61DAFB"/>
      <stop offset="100%" style="stop-color:#282C34"/>
    </linearGradient>
    <linearGradient id="vueGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#42B883"/>
      <stop offset="100%" style="stop-color:#35495E"/>
    </linearGradient>
    <linearGradient id="inertiaGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#9553E9"/>
      <stop offset="100%" style="stop-color:#764BA2"/>
    </linearGradient>
    <linearGradient id="livewireGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#FB70A9"/>
      <stop offset="100%" style="stop-color:#FF2D20"/>
    </linearGradient>
  </defs>
  <!-- Laravel Backend -->
  <rect x="275" y="160" width="250" height="100" rx="12" fill="url(#laravelGrad)" stroke="#fff" stroke-width="2"/>
  <text x="400" y="205" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="18" font-weight="bold">Laravel Backend</text>
  <text x="400" y="230" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="12">API · Blade · SSR · Auth</text>

  <!-- Browser / User -->
  <rect x="350" y="20" width="100" height="50" rx="8" fill="#4A90D9" stroke="#fff" stroke-width="1"/>
  <text x="400" y="52" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14">Kullanıcı</text>

  <!-- React SPA -->
  <rect x="50" y="320" width="140" height="80" rx="10" fill="url(#reactGrad)" stroke="#fff" stroke-width="1"/>
  <text x="120" y="355" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">React</text>
  <text x="120" y="378" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">REST API</text>

  <!-- Vue SPA -->
  <rect x="210" y="320" width="140" height="80" rx="10" fill="url(#vueGrad)" stroke="#fff" stroke-width="1"/>
  <text x="280" y="355" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">Vue.js</text>
  <text x="280" y="378" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">REST API</text>

  <!-- Inertia -->
  <rect x="450" y="320" width="140" height="80" rx="10" fill="url(#inertiaGrad)" stroke="#fff" stroke-width="1"/>
  <text x="520" y="355" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">Inertia.js</text>
  <text x="520" y="378" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">Vue/React + SSR</text>

  <!-- Livewire -->
  <rect x="610" y="320" width="140" height="80" rx="10" fill="url(#livewireGrad)" stroke="#fff" stroke-width="1"/>
  <text x="680" y="355" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">Livewire</text>
  <text x="680" y="378" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">Blade + AJAX</text>

  <!-- Arrows: User to frameworks -->
  <path d="M400 70 L400 120" stroke="#94a3b8" stroke-width="2" fill="none" marker-end="url(#arrow)"/>
  <path d="M120 320 L120 280 L400 260 L400 260" stroke="#94a3b8" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
  <path d="M280 320 L280 280" stroke="#94a3b8" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
  <path d="M520 320 L520 280" stroke="#94a3b8" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
  <path d="M680 320 L680 280 L400 260" stroke="#94a3b8" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>

  <!-- Arrows: Laravel to frameworks (response) -->
  <path d="M275 210 L120 300" stroke="#22c55e" stroke-width="2" fill="none"/>
  <path d="M325 210 L280 300" stroke="#22c55e" stroke-width="2" fill="none"/>
  <path d="M475 210 L520 300" stroke="#22c55e" stroke-width="2" fill="none"/>
  <path d="M525 210 L680 300" stroke="#22c55e" stroke-width="2" fill="none"/>

  <!-- Legend -->
  <rect x="50" y="420" width="12" height="12" fill="#94a3b8"/>
  <text x="68" y="431" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">İstek</text>
  <rect x="150" y="420" width="12" height="12" fill="#22c55e"/>
  <text x="168" y="431" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">Yanıt / Veri</text>
</svg>
<figcaption class="mt-3 text-center text-sm text-gray-500 dark:text-zinc-400">Laravel Backend ile Frontend Framework'lerin Veri Akışı</figcaption>
</figure>

<p>Diyagramda görüldüğü gibi, tüm frontend yaklaşımları Laravel backend ile iletişim kurar. React ve Vue SPA modellerinde API üzerinden veri alınır; Inertia.js sayfa bazlı veri paylaşımı kullanır; Livewire ise Blade ile birlikte sunucu tarafında render edilip AJAX ile güncellenir.</p>

<h2 id="secim-kriterleri">Hangi Yaklaşım Ne Zaman?</h2>

<ul>
<li><strong>Inertia.js:</strong> Laravel'e aşina ekipler, hızlı geliştirme, SEO ihtiyacı olan projeler.</li>
<li><strong>Livewire:</strong> Minimum JavaScript, hızlı prototype, form ağırlıklı uygulamalar.</li>
<li><strong>Vue/React + API:</strong> Büyük SPA, mobil uygulama ile paylaşılan API, mikro frontend.</li>
</ul>

<h2 id="sonuc">Sonuç</h2>

<p>Laravel, frontend tercihinize göre esnek bir backend sunar. Inertia.js ve Livewire Laravel ekosistemine sıkı entegredir; Vue ve React ise tam bağımsız SPA için ideal seçeneklerdir. Proje gereksinimlerinize ve ekip yetkinliğinize göre doğru yaklaşımı seçmek, uzun vadede bakımı kolay ve ölçeklenebilir bir uygulama sağlar.</p>
HTML;

        BlogPost::updateOrCreate(
            ['slug' => $slug],
            [
                'user_id' => $user->id,
                'blog_category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'excerpt' => 'Laravel backend ile hangi frontend framework\'leri kullanılır? Inertia.js, Livewire, Vue ve React karşılaştırması, mimari diyagram ve seçim kriterleri.',
                'content' => trim($content),
                'image' => null,
                'status' => 'published',
                'published_at' => now(),
                'meta_title' => 'Laravel Backend\'e En Uygun Frontend Framework\'ler',
                'meta_description' => 'Inertia.js, Livewire, Vue ve React: Laravel ile frontend seçenekleri, mimari ve karşılaştırma.',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        BlogPost::where('slug', 'laravel-backend-frontend-frameworkler')->delete();
    }
};
