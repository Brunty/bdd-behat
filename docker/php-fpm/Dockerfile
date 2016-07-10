FROM php:7.0-fpm

MAINTAINER Matt Brunt <matt@mfyu.co.uk>

RUN docker-php-ext-install pdo pdo_mysql
RUN usermod -u 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer