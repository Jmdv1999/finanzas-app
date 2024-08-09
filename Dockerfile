FROM php:8.0-fpm
WORKDIR /var/www/html
COPY . .
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
RUN composer install --no-dev
CMD ["php-fpm"]
