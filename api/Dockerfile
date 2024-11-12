FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./api .

RUN composer install --prefer-dist --no-scripts --no-interaction

EXPOSE 8080

CMD php yii serve 0.0.0.0 --port=8080

# EXPOSE 9000
# CMD ["php-fpm"]