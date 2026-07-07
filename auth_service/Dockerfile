FROM php:8.4-cli-alpine

RUN apk add --no-cache \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
        libxml2-dev \
        sqlite-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) \
        intl \
        mbstring \
        zip \
        pdo_sqlite \
        xml \
        dom

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY auth_service/composer.json auth_service/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

COPY auth_service/ ./

RUN composer dump-autoload --optimize --no-dev

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
