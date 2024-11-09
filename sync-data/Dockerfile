FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./sync-data .

RUN composer install --prefer-dist --no-scripts --no-interaction

RUN composer require predis/predis

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN 

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000

# EXPOSE 9000
# CMD ["php-fpm"]