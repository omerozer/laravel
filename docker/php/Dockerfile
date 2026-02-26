FROM php:8.2-fpm

# Sistem bağımlılıkları
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    libzip-dev

# PHP eklentileri (intl Filament için gerekli)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# PHP-FPM: nginx (başka konteyner) bağlanabilsin diye tüm arayüzlerde dinle
RUN sed -i 's/listen = 127.0.0.1:9000/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf

# Composer kurulumu
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
