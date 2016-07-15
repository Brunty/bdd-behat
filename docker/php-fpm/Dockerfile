FROM php:7.0-fpm

MAINTAINER Matt Brunt <matt@mfyu.co.uk>

RUN docker-php-ext-install pdo pdo_mysql

COPY 10-opcache-development.ini /usr/local/etc/php/conf.d/
COPY php.ini-development /usr/local/etc/php/php.ini
RUN usermod -u 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer