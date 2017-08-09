FROM php:apache

RUN apt-get update && apt-get install -y \
        php-gettext

RUN locale-gen fi_FI.UTF-8

COPY ./ /var/www/html/