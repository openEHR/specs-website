FROM php:8.1-apache

LABEL name='Specifications website' vendor="openEHR"

RUN apt-get update -qy \
 && DEBIAN_FRONTEND=noninteractive apt-get install -qy \
    git \
    libzip-dev unzip \
 && docker-php-ext-install zip \
 && apt-get autoremove -qy \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* /var/log/apt/*

ENV APACHE_DOCUMENT_ROOT /data/website/public
RUN a2enmod rewrite \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod status \
    && sed -ri -e 's!Require local!Require host specs-website-apache-exporter-1.specs-website_monitor!g' /etc/apache2/mods-enabled/status.conf \
    && echo "ServerName specifications" >> /etc/apache2/apache2.conf \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
EXPOSE 80

COPY . /data/website
WORKDIR /data/website

ENV COMPOSER_HOME /data/composer
RUN mv ./entrypoint.sh /entrypoint.sh && chmod +x /entrypoint.sh \
  && install -d -m 0755 -o 33 -g 33 /tmp/cache /data/website/vendor /data/composer /data/repos /data/releases \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER 33:33
VOLUME /data/repos
VOLUME /data/releases

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
CMD ["apache2-foreground"]
