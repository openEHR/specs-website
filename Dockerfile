FROM php:7.3-apache

RUN apt-get update; exit 0
RUN apt-get install -y git zlib1g-dev libzip-dev \
 && docker-php-ext-install zip \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

RUN apt-get install -y wget curl unzip mc \
 && docker-php-ext-install mbstring \
 && pecl install xdebug

RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev zlib1g-dev \
 && docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
 && docker-php-ext-install gd 

LABEL name='Specifications server' vendor="openEHR"

RUN sed -i 's!/var/www/public!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/public /var/www/html 

# RUN mkdir /var/www/git \
#    && mkdir /var/www/git/specifications \
#    && mkdir /var/www/vhosts \
#    && mkdir /var/www/vhosts/openehr.org 

EXPOSE 80

RUN docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
EXPOSE 9000

VOLUME /var/www/html
VOLUME /var/www/git
VOLUME /var/www/vhosts
