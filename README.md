# Laravel + MySQL (Docker)

Docker ile Laravel ve MySQL kurulumu.

## Hızlı başlangıç

```bash
# Kurulum scriptini çalıştır (Laravel indirir, DB ayarlarını yapar)
chmod +x init.sh
./init.sh

# Container'ları başlat
docker compose up -d
```

Uygulama: **http://localhost:8000**

## Manuel kurulum

```bash
# 1. MySQL ile birlikte container'ları başlat
docker compose up -d mysql

# 2. Laravel projesi oluştur
docker compose run --rm app composer create-project laravel/laravel . --prefer-dist

# 3. src/.env dosyasında DB ayarlarını güncelle:
#    DB_HOST=mysql
#    DB_DATABASE=laravel
#    DB_USERNAME=laravel
#    DB_PASSWORD=secret

# 4. Key ve migration
docker compose run --rm app php artisan key:generate
docker compose run --rm app php artisan migrate --force

# 5. Tüm servisleri başlat
docker compose up -d
```

## Servisler

| Servis | Port | Açıklama |
|--------|------|----------|
| Nginx  | 8000 | Web sunucu |
| MySQL  | 3306 | Veritabanı |
| App    | -    | PHP-FPM (internal) |

## Yararlı komutlar

```bash
# Composer paket ekle
docker compose run --rm app composer require paket-adi

# Artisan komutları
docker compose run --rm app php artisan migrate

# Container'lara shell
docker compose exec app bash
docker compose exec mysql mysql -u laravel -psecret laravel
```
