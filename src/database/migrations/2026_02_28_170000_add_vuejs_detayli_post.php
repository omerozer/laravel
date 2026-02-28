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

        $title = 'Vue.js Rehberi: Komponent Mimarisi ve Reaktivite';
        $slug = 'vuejs-rehberi-komponent-mimarisi-reaktivite';

        $content = <<<'HTML'
<h2 id="vuejs-nedir">Vue.js Nedir ve Neden Öğrenmelisin?</h2>

<p>Vue.js, 2014'te Evan You tarafından geliştirilen, ilerleyen şekilde benimsenebilen (progressive) bir JavaScript framework'üdür. Basit bir butondan başlayıp tam teşekküllü tek sayfa uygulamalarına (SPA) kadar ölçeklenebilir. Vue, öğrenmesi kolay, dokümantasyonu güçlü ve topluluk desteği geniş bir araçtır.</p>

<h2 id="reaktivite">Reaktivite: Veri Değişince Ekran Güncellenir</h2>

<p>Vue'nun en güçlü özelliklerinden biri <strong>reaktivite</strong>dir. Veri değiştiğinde, ekrandaki ilgili kısımlar otomatik güncellenir. Manuel DOM manipülasyonu yapmanıza gerek kalmaz. Örneğin <code>count</code> değişkenini artırdığınızda, ekrandaki sayaç kendiliğinden güncellenir.</p>

<h2 id="komponent-mimarisi">Komponent Mimarisi: Parçalara Bölünmüş Arayüz</h2>

<p>Vue uygulamaları komponentlerden oluşur. Her komponent kendi template'i, mantığı ve stilini içerir. Böylece kod tekrarı azalır, bakım kolaylaşır ve ekipler paralel çalışabilir. <code>ProductCard</code>, <code>UserAvatar</code> gibi komponentler tekrar kullanılabilir bloklardır.</p>

<h2 id="vue-mimarisi">Vue Uygulama Mimarisi ve Veri Akışı</h2>

<p>Aşağıdaki diyagram, tipik bir Vue uygulamasının yapısını ve veri akışını gösterir:</p>

<figure class="my-8 rounded-xl overflow-hidden border border-gray-200 dark:border-white/10 bg-white/50 dark:bg-white/5 p-4 sm:p-6" role="group" aria-labelledby="vue-diagram-caption">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 520" class="w-full max-w-3xl mx-auto" style="max-height: 420px;" role="img" aria-labelledby="vue-diagram-caption">
  <title>Vue.js uygulama mimarisi: App kök komponenti, alt komponentler ve veri akışı</title>
  <defs>
    <linearGradient id="vueGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#42B883"/>
      <stop offset="100%" style="stop-color:#35495E"/>
    </linearGradient>
    <linearGradient id="compGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#64748b"/>
      <stop offset="100%" style="stop-color:#475569"/>
    </linearGradient>
    <linearGradient id="dataGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" style="stop-color:#8b5cf6"/>
      <stop offset="100%" style="stop-color:#6366f1"/>
    </linearGradient>
  </defs>
  <!-- App (root) -->
  <rect x="350" y="30" width="200" height="70" rx="10" fill="url(#vueGrad1)" stroke="#fff" stroke-width="2"/>
  <text x="450" y="62" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="16" font-weight="bold">App.vue</text>
  <text x="450" y="88" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="11">Root Component</text>

  <!-- RouterView -->
  <rect x="50" y="180" width="250" height="100" rx="8" fill="#f1f5f9" stroke="#94a3b8" stroke-width="1"/>
  <text x="175" y="215" text-anchor="middle" fill="#334155" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">RouterView</text>
  <text x="175" y="240" text-anchor="middle" fill="#64748b" font-family="system-ui,sans-serif" font-size="11">Sayfa komponentleri buraya</text>
  <text x="175" y="260" text-anchor="middle" fill="#64748b" font-family="system-ui,sans-serif" font-size="10">(Home, Ürünler, Sepet)</text>

  <!-- Header, Footer -->
  <rect x="350" y="180" width="200" height="50" rx="8" fill="url(#compGrad)" stroke="#fff" stroke-width="1"/>
  <text x="450" y="212" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="12">Header + Footer</text>

  <!-- Pinia Store -->
  <rect x="600" y="180" width="250" height="100" rx="8" fill="#e0e7ff" stroke="#818cf8" stroke-width="1"/>
  <text x="725" y="215" text-anchor="middle" fill="#4338ca" font-family="system-ui,sans-serif" font-size="14" font-weight="bold">Pinia Store</text>
  <text x="725" y="240" text-anchor="middle" fill="#6366f1" font-family="system-ui,sans-serif" font-size="11">Merkezi state</text>
  <text x="725" y="260" text-anchor="middle" fill="#6366f1" font-family="system-ui,sans-serif" font-size="10">(sepet, kullanıcı, tema)</text>

  <!-- Child components -->
  <rect x="80" y="350" width="100" height="60" rx="6" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1"/>
  <text x="130" y="382" text-anchor="middle" fill="#475569" font-family="system-ui,sans-serif" font-size="11">ProductCard</text>

  <rect x="220" y="350" width="100" height="60" rx="6" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1"/>
  <text x="270" y="382" text-anchor="middle" fill="#475569" font-family="system-ui,sans-serif" font-size="11">UserAvatar</text>

  <rect x="360" y="350" width="100" height="60" rx="6" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1"/>
  <text x="410" y="382" text-anchor="middle" fill="#475569" font-family="system-ui,sans-serif" font-size="11">SearchBar</text>

  <rect x="500" y="350" width="100" height="60" rx="6" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1"/>
  <text x="550" y="382" text-anchor="middle" fill="#475569" font-family="system-ui,sans-serif" font-size="11">CartWidget</text>

  <rect x="640" y="350" width="100" height="60" rx="6" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1"/>
  <text x="690" y="382" text-anchor="middle" fill="#475569" font-family="system-ui,sans-serif" font-size="11">Notification</text>

  <!-- Arrows: App to sections -->
  <path d="M400 100 L175 180" stroke="#94a3b8" stroke-width="2" fill="none"/>
  <path d="M450 100 L450 180" stroke="#94a3b8" stroke-width="2" fill="none"/>
  <path d="M500 100 L725 180" stroke="#94a3b8" stroke-width="2" fill="none"/>

  <!-- Arrows: RouterView to components -->
  <path d="M100 280 L130 350" stroke="#22c55e" stroke-width="1.5" fill="none"/>
  <path d="M175 280 L270 350" stroke="#22c55e" stroke-width="1.5" fill="none"/>
  <path d="M250 280 L410 350" stroke="#22c55e" stroke-width="1.5" fill="none"/>

  <!-- Arrows: Store to components -->
  <path d="M650 280 L550 350" stroke="#8b5cf6" stroke-width="1.5" fill="none"/>
  <path d="M725 280 L690 350" stroke="#8b5cf6" stroke-width="1.5" fill="none"/>

  <!-- Legend -->
  <rect x="50" y="450" width="14" height="14" fill="#94a3b8"/>
  <text x="70" y="462" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">Hiyerarşi</text>
  <rect x="150" y="450" width="14" height="14" fill="#22c55e"/>
  <text x="170" y="462" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">props / veri</text>
  <rect x="260" y="450" width="14" height="14" fill="#8b5cf6"/>
  <text x="280" y="462" font-family="system-ui,sans-serif" font-size="11" fill="#64748b">store / state</text>
</svg>
<figcaption id="vue-diagram-caption" class="mt-3 text-center text-sm text-gray-500 dark:text-zinc-400">Vue.js uygulama mimarisi: kök komponent, sayfa yapısı ve alt komponentler</figcaption>
</figure>

<h2 id="vue-router">Vue Router: Sayfalar Arasında Gezinme</h2>

<p>Vue Router, tek sayfa uygulamalarında URL'e göre farklı sayfa komponentlerini göstermenizi sağlar. "/" ana sayfayı, "/sepet" sepet sayfasını açar. Her rota bir sayfa komponentine karşılık gelir.</p>

<h2 id="pinia-state">Pinia ile State Yönetimi</h2>

<p>Pinia, Vue'nun resmi state yönetim aracıdır. Birden fazla komponentin ihtiyaç duyduğu verileri (sepet, kullanıcı bilgisi, tema) merkezi bir store'da tutar. Sepet store'u güncellenince Header'daki sepet ikonu ve Sepet sayfası aynı anda güncellenir.</p>

<h2 id="vue-backend-uyumluluk">Vue Hangi Backend'lerle Uyumludur?</h2>

<p>Vue.js yalnızca frontend framework'üdür; backend teknolojisinden bağımsızdır. REST API veya GraphQL sunan herhangi bir backend ile çalışır. Vue, HTTP istekleri (fetch, axios) ile API'ye bağlanır, JSON yanıtlarını alır ve UI'ı günceller.</p>

<p><strong>Uyumlu backend'ler:</strong> Laravel (PHP), Express/Nest.js (Node.js), ASP.NET Core (.NET), Django/Flask (Python), Ruby on Rails, Spring Boot (Java), Go (Gin, Echo) ve diğer tüm REST/GraphQL API sunan platformlar.</p>

<h2 id="vue-backend-veri-akisi">Vue ve Backend: Veri Akışı Nasıl Çalışır?</h2>

<p>Diyagramda görüldüğü gibi: Kullanıcı Vue arayüzünde bir işlem yapar (örn. "Ürünleri getir" butonu). Vue komponenti HTTP isteği gönderir. Backend API isteği işler, veritabanından veri okur/yazar ve JSON yanıtı döner. Vue yanıtı alır, state'i günceller, reaktivite sayesinde ekran otomatik yenilenir.</p>

<figure class="my-8 rounded-xl overflow-hidden border border-gray-200 dark:border-white/10 bg-white/50 dark:bg-white/5 p-4 sm:p-6" role="group" aria-labelledby="vue-backend-caption">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 920 420" class="w-full max-w-3xl mx-auto" style="max-height: 380px;" role="img" aria-labelledby="vue-backend-caption">
  <title>Vue.js ve backend entegrasyonu: Veri akışı diyagramı</title>
  <defs>
    <linearGradient id="vueGrad2" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#42B883"/>
      <stop offset="100%" style="stop-color:#35495E"/>
    </linearGradient>
    <linearGradient id="laravelGrad2" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#FF2D20"/>
      <stop offset="100%" style="stop-color:#E74C3C"/>
    </linearGradient>
    <linearGradient id="nodeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#68A063"/>
      <stop offset="100%" style="stop-color:#333"/>
    </linearGradient>
    <linearGradient id="dbGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" style="stop-color:#336791"/>
      <stop offset="100%" style="stop-color:#1a3a52"/>
    </linearGradient>
  </defs>
  <!-- Vue SPA -->
  <rect x="30" y="120" width="180" height="180" rx="12" fill="url(#vueGrad2)" stroke="#fff" stroke-width="2"/>
  <text x="120" y="155" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="16" font-weight="bold">Vue.js SPA</text>
  <text x="120" y="180" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-family="system-ui,sans-serif" font-size="11">Komponentler</text>
  <text x="120" y="200" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-family="system-ui,sans-serif" font-size="11">Pinia / Router</text>
  <rect x="50" y="220" width="140" height="60" rx="6" fill="rgba(255,255,255,0.2)" stroke="rgba(255,255,255,0.5)" stroke-width="1"/>
  <text x="120" y="248" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">fetch / axios</text>
  <text x="120" y="265" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="10">HTTP GET/POST</text>

  <!-- Backends -->
  <rect x="280" y="80" width="140" height="90" rx="10" fill="url(#laravelGrad2)" stroke="#fff" stroke-width="1"/>
  <text x="350" y="115" text-anchor="middle" fill="white" font-family="system-ui,sans-serif" font-size="13" font-weight="bold">Laravel</text>
  <text x="350" y="138" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">PHP · REST API</text>
  <text x="350" y="155" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-family="system-ui,sans-serif" font-size="10">JSON Response</text>

  <rect x="280" y="200" width="140" height="90" rx="10" fill="url(#nodeGrad)" stroke="#fff" stroke-width="1"/>
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
  <rect x="660" y="140" width="220" height="180" rx="12" fill="url(#dbGrad)" stroke="#fff" stroke-width="1"/>
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

<p><strong>Özet:</strong> Vue backend'e bağımlı değildir. REST veya GraphQL endpoint'leri sunan her dil ve framework ile çalışır. Vue sadece HTTP ile iletişim kurar; backend hangi teknolojiyi kullanırsa kullansın, JSON alışverişi yeterlidir.</p>

<h2 id="kullanim-ornekleri">Kullanım Örnekleri</h2>

<p><strong>E-ticaret sitesi:</strong> Ürün kartları (<code>ProductCard</code>), filtre (<code>SearchBar</code>), sepet widget'ı (<code>CartWidget</code>), ödeme adımları (wizard komponenti). Her biri ayrı komponent, birlikte tam deneyim.</p>

<p><strong>Yönetim paneli:</strong> Sidebar menü, tablo, grafik, form modal'ları. Vue ile modüler dashboard'lar hızlıca inşa edilir. Veri değişince grafikler reaktivite sayesinde otomatik yenilenir.</p>

<p><strong>Form sihirbazı:</strong> Adım adım kayıt veya sipariş süreci. Her adım bir komponent, Vue Router adımlar arasında geçişi yönetir. Sihirbaz mantığı tek yerde toplanır, adım içerikleri değiştirilebilir.</p>

<h2 id="composition-api">Composition API: Mantığı Yeniden Kullanmak</h2>

<p>Vue 3 ile gelen Composition API, benzer mantığı <code>composable</code> fonksiyonlarda toplamanızı sağlar. Örneğin <code>useCounter</code>, <code>useFetch</code> gibi fonksiyonlar farklı komponentlerde tekrar kullanılabilir.</p>

<h2 id="sonuc">Sonuç</h2>

<p>Vue.js, öğrenmesi kolay ve ölçeklenebilir bir framework'tür. Komponent mimarisi, reaktivite ve ekosistemi (Router, Pinia) ile hem küçük projelerde hem kurumsal uygulamalarda güvenle kullanılabilir.</p>
HTML;

        BlogPost::updateOrCreate(
            ['slug' => $slug],
            [
                'user_id' => $user->id,
                'blog_category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'excerpt' => 'Vue.js nedir? Komponent mimarisi, reaktivite, backend uyumluluğu (Laravel, Node, Django, .NET) ve veri akışı ile SPA geliştirme rehberi.',
                'content' => trim($content),
                'image' => null,
                'status' => 'published',
                'published_at' => now(),
                'meta_title' => 'Vue.js Rehberi: Komponent Mimarisi ve Reaktivite',
                'meta_description' => 'Vue.js komponent mimarisi, reaktivite, backend uyumluluğu ve veri akışı. Laravel, Express, Django, .NET ile Vue nasıl çalışır?',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        BlogPost::where('slug', 'vuejs-rehberi-komponent-mimarisi-reaktivite')->delete();
    }
};
