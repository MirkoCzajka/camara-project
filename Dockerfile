FROM php:8.3-fpm

# Extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev libpng-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_mysql intl zip bcmath opcache \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
