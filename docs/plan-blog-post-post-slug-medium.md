# Blog: /post/{slug} Public Sayfa ve Medium Tarzı — Plan

## Migration

**Mevcut kapsamda (URL + Medium layout) yeni migration gerekmez.**

`blog_posts` tablosu zaten gerekli alanlara sahip ([database/migrations/2026_02_26_132309_create_blog_posts_table.php](src/database/migrations/2026_02_26_132309_create_blog_posts_table.php)):

- `slug` (unique) — `/post/{slug}` için
- `title`, `excerpt`, `content` (longText)
- `image`, `published_at`, `status`
- `meta_title`, `meta_description`, `view_count`
- `user_id`, `blog_category_id`

**İleride eklenebilecek alanlar (istersen yeni migration):**

- `reading_time` (okuma süresi, dakika) — Medium tarzı "X dk okuma" göstermek için
- Başka bir ihtiyaç olursa yeni migration dosyası eklenir

**Özet:** Bu planı uygularken yeni migration çalıştırmana gerek yok; sadece route ve view değişiklikleri yapılacak.

---

## Yapılacaklar (özet)

1. **Route:** [src/routes/web.php](src/routes/web.php) — `/blog/{slug}` → `/post/{slug}` (route adı `blog.show` kalabilir).
2. **View:** [src/resources/views/blog/show.blade.php](src/resources/views/blog/show.blade.php) — Medium tarzı layout ve tipografi (max-w-2xl/3xl, prose, başlık/meta/kapak stilleri).
3. **(Opsiyonel)** Admin’de içerik alanı RichEditor + view’da HTML render; migration gerekmez (aynı `content` kolonu kullanılır).
