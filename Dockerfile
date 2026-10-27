FROM composer:2 AS dependencies

WORKDIR /app

COPY . .

RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

FROM php:8.5-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY --from=dependencies /app/vendor ./vendor
COPY . .
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD ["/bin/bash", "-c", "touch database/database.sqlite && php artisan migrate --force && apache2-foreground"]
