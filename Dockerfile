# escape=`
FROM php:7.4-fpm-alpine

WORKDIR /var/www/api

#RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/api/
COPY .env /var/www/api/

EXPOSE 8110

RUN composer update
RUN composer install
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8110"]