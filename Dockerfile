FROM php:8.1-apache-bullseye

LABEL name='Specifications server' vendor="openEHR"

RUN apt-get update -qy \
 && DEBIAN_FRONTEND=noninteractive apt-get install -qy \
    wget curl \
    git \
    zlib1g-dev libzip-dev unzip \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev zlib1g-dev \
    libonig-dev \
 && docker-php-source extract \
 && docker-php-ext-install zip \
 && docker-php-ext-install mbstring \
 && docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype \
 && docker-php-ext-install gd \
 && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
 && docker-php-source delete \
 && apt-get autoremove -qy \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* /var/log/apt/*

RUN a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && mkdir /var/www/html \
 && mv /var/www/public /var/www/html/public

RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

# RUN mkdir /var/www/git \
#    && mkdir /var/www/git/specifications \
#    && mkdir /var/www/vhosts \
#    && mkdir /var/www/vhosts/openehr.org 

WORKDIR /var/www
EXPOSE 80

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
EXPOSE 9003

VOLUME /var/www/html
VOLUME /var/www/git
VOLUME /var/www/vhosts


ARG user=guest
ARG group=guests
ARG uid=1000
ARG gid=1000
RUN groupadd -g ${gid} ${group}
RUN useradd -u ${uid} -g ${group} -s /bin/sh -m ${user} # <--- the '-m' create a user home directory

USER 33:33
CMD ["apache2-foreground"]
