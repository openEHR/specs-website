FROM php:7.3-apache

LABEL name='Specifications server' vendor="openEHR"

RUN apt-get update; exit 0
RUN apt-get install -y wget curl \
    git \
    zlib1g-dev libzip-dev unzip \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev zlib1g-dev \
 && docker-php-ext-install zip \
 && docker-php-ext-install mbstring \
 && docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
 && docker-php-ext-install gd \
 && apt-get clean

RUN a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && mkdir /var/www/html \
 && mv /var/www/public /var/www/html/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

# RUN mkdir /var/www/git \
#    && mkdir /var/www/git/specifications \
#    && mkdir /var/www/vhosts \
#    && mkdir /var/www/vhosts/openehr.org 

WORKDIR /var/www
EXPOSE 80

RUN pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
EXPOSE 9000

VOLUME /var/www/html
VOLUME /var/www/git
VOLUME /var/www/vhosts


ARG user=guest
ARG group=guests
ARG uid=1000
ARG gid=1000
RUN groupadd -g ${gid} ${group}
RUN useradd -u ${uid} -g ${group} -s /bin/sh -m ${user} # <--- the '-m' create a user home directory
