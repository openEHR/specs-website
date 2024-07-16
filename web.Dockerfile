FROM php:8.1-apache

LABEL name='Specifications website' vendor="openEHR"

RUN apt-get update -qy \
 && DEBIAN_FRONTEND=noninteractive apt-get install -qy \
    git \
    zlib1g-dev libzip-dev unzip \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev \
    libonig-dev \
 && docker-php-source extract \
 && docker-php-ext-install zip \
 && docker-php-ext-install mbstring \
 && docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype \
 && docker-php-ext-install gd \
 && docker-php-source delete \
 && apt-get autoremove -qy \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* /var/log/apt/*

ENV APACHE_DOCUMENT_ROOT /data/website/public

RUN a2enmod rewrite \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
EXPOSE 80

COPY . /data/website
WORKDIR /data/website

ENV COMPOSER_HOME /data/composer
RUN mv ./entrypoint.sh /entrypoint.sh && chmod +x /entrypoint.sh \
  && install -d -m 0755 -o 33 -g 33 /data/website/vendor /data/composer /data/repos /data/releases \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER 33:33
VOLUME /data/repos
VOLUME /data/releases

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
CMD ["apache2-foreground"]
