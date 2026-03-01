#!/bin/bash
set -e
cd "$(dirname "$0")"

echo "🚀 Laravel Docker kurulumu başlatılıyor..."

# src klasörü oluştur
mkdir -p src

# Laravel yoksa kur
if [ ! -f "src/composer.json" ]; then
  echo "📦 Laravel indiriliyor..."
  docker compose run --rm -w /var/www/html app composer create-project laravel/laravel . --prefer-dist
  echo "✅ Laravel kuruldu."
else
  echo "✅ Laravel zaten kurulu."
  # GitHub/clone sonrası: vendor yoksa composer install (vendor .gitignore'da)
  if [ ! -d "src/vendor" ]; then
    echo "📦 Composer bağımlılıkları yükleniyor (vendor repo'da yok)..."
    docker compose run --rm -w /var/www/html app composer install --no-interaction
    echo "✅ Bağımlılıklar kuruldu."
  fi
fi

# .env dosyasını güncelle (DB ayarları)
echo "⚙️  Veritabanı ayarları yapılıyor..."
cat > src/.env << 'EOF'
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
EOF

# APP_KEY oluştur
docker compose run --rm -w /var/www/html app php artisan key:generate

# Migration
echo "🗄️  Veritabanı tabloları oluşturuluyor..."
docker compose run --rm -w /var/www/html app php artisan migrate --force

echo ""
echo "✅ Kurulum tamamlandı!"
echo "   Uygulama: http://localhost:8000"
echo ""
echo "Başlatmak için: docker compose up -d"
