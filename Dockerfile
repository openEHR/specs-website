ARG PHP_VERSION=8.3

#
# Application base
#
FROM php:${PHP_VERSION}-fpm-alpine AS base
LABEL name='Specifications website' vendor="openEHR"
# Install extensions and tools
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN apk update --no-cache && apk upgrade --no-cache \
    && apk add --no-cache \
        bash \
        curl \
        zstd \
        gzip \
        git \
    && curl --etag-compare etag.txt --etag-save etag.txt --remote-name https://curl.se/ca/cacert.pem \
    && install-php-extensions \
        opcache \
    && cp -f "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# Add custom extension configs
COPY docker/php/opcache.ini docker/php/zz-overwrites.ini /usr/local/etc/php/conf.d/
COPY docker/php-fpm/zz-overwrites.conf /usr/local/etc/php-fpm.d/
# Defining XDG Base Directories
ENV APP_CACHE_DIR=/data/.cache/app
ENV REPOS_ROOT=/data/repos
ENV RELEASES_ROOT=/data/releases
RUN mkdir -m 0775 -p $APP_CACHE_DIR $REPOS_ROOT $RELEASES_ROOT \
    && chown -R www-data:www-data $APP_CACHE_DIR $REPOS_ROOT $RELEASES_ROOT
# Source code location
WORKDIR /app
VOLUME $REPOS_ROOT
VOLUME $RELEASES_ROOT
EXPOSE 9000


FROM base AS development
# Install development extensions and tools
ENV APP_ENV=development
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV XDG_CONFIG_HOME=/data/.config XDG_CACHE_HOME=/data/.cache
RUN cp -f "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    && adduser -S -u 1000 -G www-data wsl-user \
    && install-php-extensions \
      xdebug \
      @composer \
    && mkdir -m 0775 -p $XDG_CONFIG_HOME/composer $XDG_CACHE_HOME/composer \
    && chown -R wsl-user:www-data $XDG_CONFIG_HOME/composer $XDG_CACHE_HOME/composer
# Add development custom extension configs
COPY docker/php/zz-development.ini /usr/local/etc/php/conf.d/


#
# PHP Depencencies (for production)
#
FROM development AS vendor-builder
COPY . .
RUN --mount=type=cache,target=$XDG_CONFIG_HOME \
    --mount=type=cache,target=$XDG_CACHE_HOME \
    composer install --no-interaction --no-progress --no-ansi --no-scripts --no-dev --classmap-authoritative --optimize-autoloader


#
# Application (production)
#
FROM base AS production
# APP production envs
ENV APP_ENV=production
# Add the source code
COPY config ./config
COPY public ./public
COPY scripts ./scripts
COPY src ./src
COPY templates ./templates
COPY --from=vendor-builder /app/vendor/ ./vendor
