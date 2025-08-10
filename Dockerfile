FROM composer:2 AS composer

FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash icu-dev oniguruma-dev libzip-dev zip unzip git curl shadow \
    freetype-dev libjpeg-turbo-dev libpng-dev \
    mysql-client

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) \
    gd intl mbstring pdo pdo_mysql zip bcmath

RUN docker-php-ext-enable opcache

RUN usermod -u 1000 www-data || true

WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-progress --no-scripts || true

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize

EXPOSE 9000
CMD ["php-fpm", "-F"]
