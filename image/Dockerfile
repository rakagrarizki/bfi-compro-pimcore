FROM php:7.2.12-fpm-alpine

RUN set -ex \
    && apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
	zlib-dev \ 
	icu-dev \
	\
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr \
        --with-png-dir=/usr \
        --with-jpeg-dir=/usr \
    && docker-php-ext-install gd \
	&& docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN docker-php-ext-install pdo pdo_mysql mysqli exif zip

