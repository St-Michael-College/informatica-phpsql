FROM php:8.2-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY php/dev.ini /usr/local/etc/php/conf.d/dev.ini
