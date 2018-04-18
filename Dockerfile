FROM abiosoft/caddy:php

COPY Caddyfile /etc/Caddyfile

COPY src/ /app/src
COPY .env /app/.env
COPY composer.json /app/composer.json
COPY composer.lock /app/.env

COPY . /app
WORKDIR /app

EXPOSE 2015

RUN composer install --prefer-source --no-interaction