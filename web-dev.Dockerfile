# based on web.Dcokerfile build image
FROM specs-website-web:latest

USER 0:0
RUN apt-get update -qy \
 && DEBIAN_FRONTEND=noninteractive apt-get install -qy \
    wget curl \
 && docker-php-source extract \
 && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
 && docker-php-source delete \
 && apt-get autoremove -qy \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* /var/log/apt/*

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ENV APP_SYSTEM=development
EXPOSE 9003
VOLUME /data/website

ARG user=guest
ARG group=guests
ARG uid=1000
ARG gid=1000
RUN groupadd -g ${gid} ${group} \
    && useradd -u ${uid} -g ${group} -s /bin/sh -m ${user} \
    && usermod -a -G ${group} www-data \
    && usermod -a -G www-data ${user}

USER 33:33
