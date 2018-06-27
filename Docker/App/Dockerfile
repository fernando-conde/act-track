FROM php:fpm-alpine

RUN apk --no-cache update
RUN apk --no-cache upgrade

RUN docker-php-ext-configure opcache --enable-opcache
RUN docker-php-ext-install opcache

COPY ./config/* $PHP_INI_DIR/conf.d/