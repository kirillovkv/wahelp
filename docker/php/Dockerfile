FROM php:8.3.0-fpm

RUN apt-get update --fix-missing && apt-get install -y \
	git wget unzip gnupg htop sudo procps zip \
	libmcrypt-dev \
	libjpeg-dev \
	libcurl4-gnutls-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
	libc-client-dev libkrb5-dev \
	libldap2-dev \
	libxml2-dev \
	libbz2-dev \
	zlib1g-dev \
	libicu-dev \
	libonig-dev \
    libpq-dev \
	htmldoc \
	supervisor \
	libzip-dev \
    libxslt-dev && apt-get clean

RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd

RUN docker-php-ext-configure pcntl --enable-pcntl
RUN docker-php-ext-configure intl --enable-intl
RUN docker-php-ext-configure mbstring --enable-mbstring
RUN docker-php-ext-install -j$(nproc) curl
RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install -j$(nproc) pcntl
RUN docker-php-ext-install -j$(nproc) bcmath
RUN docker-php-ext-install -j$(nproc) ctype
RUN docker-php-ext-install -j$(nproc) opcache

RUN apt install -y libzip-dev
RUN docker-php-ext-install -j$(nproc) zip

RUN docker-php-ext-install -j$(nproc) pgsql
RUN docker-php-ext-install -j$(nproc) pdo_pgsql
RUN docker-php-ext-install -j$(nproc) xml

# Установка Composer
RUN apt-get update --fix-missing && apt-get install -y \
    nano && apt-get clean
RUN sudo rm -f /usr/local/bin/composer
RUN sudo curl -s https://getcomposer.org/installer | php
RUN sudo mv composer.phar /usr/local/bin/composer