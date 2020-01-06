FROM php:7.4-apache

RUN apt-get update && pecl install redis && docker-php-ext-enable redis
COPY ./.docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY ./.docker/ports.conf /etc/apache2/ports.conf
RUN a2enmod rewrite