FROM php:8.3-fpm-alpine

ARG USER_ID
ARG GROUP_ID

RUN set -ex \
    && apk add --no-cache $PHPIZE_DEPS \
    && apk add --update linux-headers

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN apk add libpng-dev libzip-dev git bash shadow ffmpeg
RUN apk add supervisor
RUN apk add --update npm

RUN docker-php-ext-install gd zip pdo pdo_mysql sockets

RUN wget https://getcomposer.org/installer -O - -q  | php -- --install-dir=/bin --filename=composer --quiet

COPY ./supervisor/supervisord.conf /etc/supervisor/supervisord.conf

RUN echo "alias ll='ls -alF'" >> /home/www-data/.bashrc
RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

USER "${USER_ID}:${GROUP_ID}"

WORKDIR /var/www

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
