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

        $title = 'Vue.js Hangi Backend\'lerle Uyumludur ve Nasıl Çalışır?';
        $slug = 'vuejs-backend-uyumluluk-nasil-calisir';

        $content = <<<'HTML'
<h2 id="vue-backend-uyumluluk">Vue Hangi Backend'lerle Uyumludur?</h2>

<p>Vue.js yalnızca frontend framework'üdür; backend teknolojisinden bağımsızdır. REST API veya GraphQL sunan herhangi bir backend ile çalışır. Vue, HTTP istekleri (fetch, axios) ile API'ye bağlanır, JSON yanıtlarını alır ve UI'ı günceller.</p>

<p><strong>Uyumlu backend'ler:</strong> Laravel (PHP), Express/Nest.js (Node.js), ASP.NET Core (.NET), Django/Flask (Python), Ruby on Rails, Spring Boot (Java), Go (Gin, Echo) ve diğer tüm REST/GraphQL API sunan platformlar.</p>

<h2 id="veri-akisi">Vue ve Backend: Veri Akışı Nasıl Çalışır?</h2>

<p>Kullanıcı Vue arayüzünde bir işlem yapar (örn. "Ürünleri getir" butonu). Vue komponenti HTTP isteği gönderir. Backend API isteği işler, veritabanından veri okur/yazar ve JSON yanıtı döner. Vue yanıtı alır, state'i günceller, reaktivite sayesinde ekran otomatik yenilenir. Vue veritabanına doğrudan erişmez; tüm veri alışverişi API üzerinden gerçekleşir.</p>

<figure class="my-8 rounded-xl overflow-hidden border border-gray-200 dark:border-white/10 bg-white/50 dark:bg-white/5 p-4 sm:p-6" role="group" aria-labelledby="vue-backend-caption">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 920 420" class="w-full max-w-3xl mx-auto" style="max-height: 380px;" role="img" aria-labelledby="vue-backend-caption">
  <title>Vue.js ve backend entegrasyonu: Veri akışı diyagramı</title>
  <defs>
    <linearGradient id="vbVueGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#42B883"/>
      <stop offset="100%" style="stop-color:#35495E"/>
    </linearGradient>
    <linearGradient id="vbLaravelGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#FF2D20"/>
      <stop offset="100%" style="stop-color:#E74C3C"/>
    </linearGradient>
    <linearGradient id="vbNodeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#68A063"/>
      <stop offset="100%" style="stop-color:#333"/>
    </linearGradient>
    <linearGradient id="vbDbGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" style="stop-color:#336791"/>
      <stop offset="100%" style="stop-color:#1a3a52"/>
    </linearGradient>
  </defs>
  <!-- Vue SPA -->
  <rect x="30" y="120" width="180" height="180" rx="12" fill="url(#vbVueGrad)" stroke="#fff" stroke-width="2"/>
  <text x="120" y="155" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="16" font-weight="bold">Vue.js SPA</text>
  <text x="120" y="180" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-family="system-ui,sans-serif" font-size="11">Komponentler</text>
  <text x="120" y="200" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-family="system-ui,sans-serif" font-size="11">Pinia / Router</text>
  <rect x="50" y="220" width="140" height="60" rx="6" fill="rgba(255,255,255,0.2)" stroke="rgba(255,255,255,0.5)" stroke-width="1"/>
  <text x="120" y="248" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">fetch / axios</text>
  <text x="120" y="265" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">HTTP GET/POST</text>

  <!-- Backends -->
  <rect x="280" y="80" width="140" height="90" rx="10" fill="url(#vbLaravelGrad)" stroke="#fff" stroke-width="1"/>
  <text x="350" y="115" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="13" font-weight="bold">Laravel</text>
  <text x="350" y="138" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">PHP · REST API</text>
  <text x="350" y="155" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">JSON Response</text>

  <rect x="280" y="200" width="140" height="90" rx="10" fill="url(#vbNodeGrad)" stroke="#fff" stroke-width="1"/>
  <text x="350" y="235" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="13" font-weight="bold">Express</text>
  <text x="350" y="258" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">Node.js · REST</text>
  <text x="350" y="275" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">JSON Response</text>

  <rect x="280" y="320" width="140" height="90" rx="10" fill="#512BD4" stroke="#fff" stroke-width="1"/>
  <text x="350" y="355" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="13" font-weight="bold">Django</text>
  <text x="350" y="378" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">Python · REST</text>
  <text x="350" y="395" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">JSON Response</text>

  <rect x="460" y="140" width="140" height="90" rx="10" fill="#5C2D91" stroke="#fff" stroke-width="1"/>
  <text x="530" y="175" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="13" font-weight="bold">.NET Core</text>
  <text x="530" y="198" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">C# · Web API</text>
  <text x="530" y="215" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">JSON Response</text>

  <!-- Database -->
  <rect x="660" y="140" width="220" height="180" rx="12" fill="url(#vbDbGrad)" stroke="#fff" stroke-width="1"/>
  <text x="770" y="175" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">Veritabanı</text>
  <text x="770" y="200" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">MySQL · PostgreSQL</text>
  <text x="770" y="225" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">MongoDB · SQLite</text>
  <rect x="690" y="245" width="160" height="50" rx="6" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
  <text x="770" y="270" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">Backend okur/yazar</text>
  <text x="770" y="285" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">Vue DB'ye direkt erişmez</text>

  <!-- Arrows: Vue to Backends (request) -->
  <path d="M210 180 L270 125" stroke="#f59e0b" stroke-width="2.5" fill="none"/>
  <path d="M210 230 L270 245" stroke="#f59e0b" stroke-width="2.5" fill="none"/>
  <path d="M210 270 L270 365" stroke="#f59e0b" stroke-width="2" fill="none"/>
  <path d="M210 200 L450 185" stroke="#f59e0b" stroke-width="2" fill="none"/>
  <text x="235" y="175" fill="#f59e0b" font-family="system-ui,sans-serif" font-size="9" font-weight="bold">İstek</text>

  <!-- Arrows: Backends to Vue (response) -->
  <path d="M280 165 L230 180" stroke="#22c55e" stroke-width="2" fill="none" stroke-dasharray="5 4"/>
  <path d="M280 265 L230 250" stroke="#22c55e" stroke-width="2" fill="none" stroke-dasharray="5 4"/>
  <path d="M420 185 L230 210" stroke="#22c55e" stroke-width="2" fill="none" stroke-dasharray="5 4"/>
  <text x="255" y="268" fill="#22c55e" font-family="system-ui,sans-serif" font-size="9" font-weight="bold">JSON</text>

  <!-- Arrows: Backends to DB -->
  <path d="M420 185 L650 185" stroke="#94a3b8" stroke-width="1.5" fill="none"/>
  <path d="M350 170 L650 220" stroke="#94a3b8" stroke-width="1.5" fill="none"/>
  <path d="M350 290 L650 260" stroke="#94a3b8" stroke-width="1.5" fill="none"/>
  <path d="M350 365 L650 300" stroke="#94a3b8" stroke-width="1.5" fill="none"/>
  <text x="500" y="240" fill="#94a3b8" font-family="system-ui,sans-serif" font-size="9">Sorgu</text>

  <!-- Legend -->
  <rect x="30" y="370" width="14" height="14" fill="#f59e0b"/>
  <text x="50" y="382" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">Vue → API (HTTP Request)</text>
  <rect x="200" y="370" width="14" height="14" fill="#22c55e"/>
  <text x="220" y="382" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">API → Vue (JSON Response)</text>
  <rect x="380" y="370" width="14" height="14" fill="#94a3b8"/>
  <text x="400" y="382" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">Backend → DB</text>
</svg>
<figcaption id="vue-backend-caption" class="mt-3 text-center text-sm text-gray-500 dark:text-zinc-400">Vue.js ve backend entegrasyonu: İstek/yanıt veri akışı</figcaption>
</figure>

<h2 id="ozet">Özet</h2>

<p>Vue backend'e bağımlı değildir. REST veya GraphQL endpoint'leri sunan her dil ve framework ile çalışır. Vue sadece HTTP ile iletişim kurar; backend hangi teknolojiyi kullanırsa kullansın, JSON alışverişi yeterlidir. Laravel, Express, Django, .NET veya Go tercih edebilirsiniz—Vue tümüyle uyumludur.</p>
HTML;

        BlogPost::updateOrCreate(
            ['slug' => $slug],
            [
                'user_id' => $user->id,
                'blog_category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'excerpt' => 'Vue.js hangi backend\'lerle uyumludur? Laravel, Express, Django, .NET ile nasıl çalışır? Veri akışı diyagramı ile açıklama.',
                'content' => trim($content),
                'image' => null,
                'status' => 'published',
                'published_at' => now(),
                'meta_title' => 'Vue.js Hangi Backend\'lerle Uyumludur ve Nasıl Çalışır?',
                'meta_description' => 'Vue.js backend uyumluluğu: Laravel, Express, Django, .NET. Veri akışı diyagramı ile Vue ve API entegrasyonu.',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        BlogPost::where('slug', 'vuejs-backend-uyumluluk-nasil-calisir')->delete();
    }
};
