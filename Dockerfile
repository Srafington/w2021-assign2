FROM php:8.0-apache

RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        libjpeg-dev -y \
        libfreetype6-dev -y

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --enable-gd

RUN docker-php-ext-install gd

RUN docker-php-ext-install pdo pdo_mysql