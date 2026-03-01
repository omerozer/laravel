#!/bin/bash
set -e
cd /var/www/html

# .env yoksa .env.example'dan oluştur (Docker için DB ayarları)
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  echo "Creating .env from .env.example..."
  cp .env.example .env
  sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
  sed -i 's/DB_USERNAME=root/DB_USERNAME=laravel/' .env
  sed -i 's/DB_PASSWORD=/DB_PASSWORD=secret/' .env
  php artisan key:generate --no-interaction
fi

# vendor yoksa otomatik composer install (clone sonrası)
if [ ! -d "vendor" ]; then
  echo "Installing Composer dependencies..."
  composer install --no-interaction --no-dev --optimize-autoloader
fi

# Vite build yoksa npm install + build (manifest 500 hatasını önler)
if [ ! -f "public/build/manifest.json" ]; then
  echo "Building frontend assets..."
  npm install --silent && npm run build
fi

# Migration (DB hazır olana kadar dene)
for i in 1 2 3 4 5; do
  php artisan migrate --force 2>/dev/null && break
  sleep 2
done

# storage:link (Hostinger parity - upload dosyaları için)
php artisan storage:link 2>/dev/null || true

exec "$@"
