FROM php:8.2.4-apache

COPY . /var/www/html

RUN docker-php-ext-install pdo_mysql

EXPOSE 80
