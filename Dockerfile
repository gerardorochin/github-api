FROM php:7.4.27-alpine

WORKDIR /usr/src/api

RUN apk update; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
      git \
      libzip-dev \
      postgresql-dev \
      zlib-dev \
  ; \
  rm -rf /tmp/* /var/cache/apk/*;

RUN docker-php-ext-install \
    pdo_pgsql \
    zip;

RUN curl -SL --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar; \
  chmod +x /usr/local/bin/composer;

COPY src/ .

RUN composer install;

CMD ["php", "-S", "0.0.0.0:8080", "public/index.php"]
