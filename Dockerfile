FROM php:7.4-apache

COPY . /var/www/html

RUN docker-php-ext-install pdo_mysql

RUN apt-get update && \
    apt-get install -y

EXPOSE 80
