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

        $title = 'Vue.js Rehberi: Hayattan Örneklerle Komponent Mimarisi ve Reaktivite';
        $slug = 'vuejs-rehberi-komponent-mimarisi-reaktivite-hayattan-ornekler';

        $content = <<<'HTML'
<h2 id="vuejs-nedir">Vue.js Nedir ve Neden Öğrenmelisin?</h2>

<p>Vue.js, 2014'te Evan You tarafından geliştirilen, ilerleyen şekilde benimsenebilen (progressive) bir JavaScript framework'üdür. Basit bir butondan başlayıp tam teşekküllü tek sayfa uygulamalarına (SPA) kadar ölçeklenebilir. Vue, öğrenmesi kolay, dokümantasyonu güçlü ve topluluk desteği geniş bir araçtır.</p>

<p><strong>Hayattan örnek:</strong> Vue'yu bir <em>LEGO seti</em> gibi düşünün. Küçük parçalarla (komponentler) başlarsınız, istediğinizde daha karmaşık modeller (uygulamalar) inşa edersiniz. Her parça kendi başına çalışır ama bir araya gelince anlamlı bütünler oluşturur.</p>

<h2 id="reaktivite">Reaktivite: Veri Değişince Ekran Güncellenir</h2>

<p>Vue'nun en güçlü özelliklerinden biri <strong>reaktivite</strong>dir. Veri değiştiğinde, ekrandaki ilgili kısımlar otomatik güncellenir. Manuel DOM manipülasyonu yapmanıza gerek kalmaz.</p>

<p><strong>Hayattan örnek:</strong> Evinizdeki <em>akıllı termostat</em> gibi. Sıcaklığı değiştirdiğinizde, klima otomatik devreye girer. Siz sadece "22 derece olsun" dersiniz; sistem geri kalanını halleder. Vue'da da <code>count</code> değişkenini artırdığınızda, ekrandaki sayaç kendiliğinden güncellenir.</p>

<h2 id="komponent-mimarisi">Komponent Mimarisi: Parçalara Bölünmüş Arayüz</h2>

<p>Vue uygulamaları komponentlerden oluşur. Her komponent kendi template'i, mantığı ve stilini içerir. Böylece kod tekrarı azalır, bakım kolaylaşır ve ekipler paralel çalışabilir.</p>

<p><strong>Hayattan örnek:</strong> Bir <em>restoran menüsü</em> düşünün. Her yemek kartı (başlık, fiyat, açıklama) aynı şablona uyar. Siz tek bir kartı değiştirdiğinizde diğerleri etkilenmez. Vue'da da <code>ProductCard</code>, <code>UserAvatar</code> gibi komponentler tekrar kullanılabilir bloklardır.</p>

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

<p>Vue Router, tek sayfa uygulamalarında URL'e göre farklı sayfa komponentlerini göstermenizi sağlar. "/" ana sayfayı, "/sepet" sepet sayfasını açar.</p>

<p><strong>Hayattan örnek:</strong> Bir <em>alışveriş merkezi planı</em> gibi düşünün. Girişte hangi mağazaya gideceğinize karar verirsiniz. Plan üzerindeki her nokta bir "rota". Vue Router, tıkladığınızda doğru "mağaza" (sayfa komponenti) açılmasını sağlar—ama aslında hepsi aynı binada.</p>

<h2 id="pinia-state">Pinia ile State Yönetimi</h2>

<p>Pinia, Vue'nun resmi state yönetim aracıdır. Birden fazla komponentin ihtiyaç duyduğu verileri (sepet, kullanıcı bilgisi, tema) merkezi bir store'da tutar.</p>

<p><strong>Hayattan örnek:</strong> Evdeki <em>ortak beyaz tahta</em> gibi. Aile fertleri alışveriş listesi, randevular gibi bilgileri oraya yazar. Herkes güncel bilgiye erişir. Vue'da da sepet store'u güncellenince Header'daki sepet ikonu ve Sepet sayfası aynı anda güncellenir.</p>

<h2 id="hayattan-kullanim">Hayattan Kullanım Örnekleri</h2>

<p><strong>E-ticaret sitesi:</strong> Ürün kartları (<code>ProductCard</code>), filtre (<code>SearchBar</code>), sepet widget'ı (<code>CartWidget</code>), ödeme adımları (wizard komponenti). Her biri ayrı komponent, birlikte tam deneyim.</p>

<p><strong>Yönetim paneli:</strong> Sidebar menü, tablo, grafik, form modal'ları. Vue ile modüler dashboard'lar hızlıca inşa edilir. Veri değişince grafikler otomatik yenilenir—tıpkı canlı borsa ekranı gibi.</p>

<p><strong>Form sihirbazı:</strong> Adım adım kayıt veya sipariş süreci. Her adım bir komponent, Vue Router adımlar arasında geçişi yönetir. Sihirbaz mantığı tek yerde toplanır, adım içerikleri değiştirilebilir.</p>

<h2 id="composition-api">Composition API: Mantığı Yeniden Kullanmak</h2>

<p>Vue 3 ile gelen Composition API, benzer mantığı <code>composable</code> fonksiyonlarda toplamanızı sağlar. Örneğin <code>useCounter</code>, <code>useFetch</code> gibi fonksiyonlar farklı komponentlerde tekrar kullanılabilir.</p>

<p><strong>Hayattan örnek:</strong> Bir <em>mutfak tarifi</em> gibi. "Sos nasıl yapılır" bölümü birçok yemekte ortaktır. Tarif defterinde bu bölümü referans verirsiniz; her yemekte sıfırdan yazmazsınız. Composition API de bu "tarif parçalarını" yeniden kullanmanızı sağlar.</p>

<h2 id="sonuc">Sonuç</h2>

<p>Vue.js, öğrenmesi kolay, ölçeklenebilir ve hayattaki benzerliklerle anlaşılması zevkli bir framework'tür. Komponent mimarisi, reaktivite ve ekosistemi (Router, Pinia) ile hem küçük projelerde hem kurumsal uygulamalarda güvenle kullanılabilir. Gerçek dünya örnekleriyle düşünmek, Vue konseptlerini somutlaştırır ve hatırlamayı kolaylaştırır.</p>
HTML;

        BlogPost::updateOrCreate(
            ['slug' => $slug],
            [
                'user_id' => $user->id,
                'blog_category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'excerpt' => 'Vue.js nedir? Komponent mimarisi, reaktivite, Vue Router ve Pinia\'yı hayattan örneklerle anlatan rehber: LEGO, termostat, restoran menüsü, AVM planı ve daha fazlası.',
                'content' => trim($content),
                'image' => null,
                'status' => 'published',
                'published_at' => now(),
                'meta_title' => 'Vue.js Rehberi: Hayattan Örneklerle Komponent ve Reaktivite',
                'meta_description' => 'Vue.js komponent mimarisi, reaktivite, Router ve Pinia. LEGO, termostat, restoran menüsü gibi hayattan örneklerle Vue nasıl çalışır?',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        BlogPost::where('slug', 'vuejs-rehberi-komponent-mimarisi-reaktivite-hayattan-ornekler')->delete();
    }
};
