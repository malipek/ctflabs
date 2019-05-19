FROM php:7.2-apache

COPY ./.docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY ./.docker/ports.conf /etc/apache2/ports.conf
RUN a2enmod rewrite