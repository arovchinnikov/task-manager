FROM php:8.1-fpm-alpine

RUN apk add --no-cache zip git curl make bash libpq-dev && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/00-custom.ini

WORKDIR /var/www/dev

CMD ["php-fpm"]
