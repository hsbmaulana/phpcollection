FROM php:8.0-alpine

ARG name=collection

WORKDIR /var/www/${name}/
COPY . .

RUN apk update && php -r "$(echo 'cmVhZGZpbGUoJ2h0dHA6Ly9nZXRjb21wb3Nlci5vcmcvaW5zdGFsbGVyJyk7Cg==' | base64 -d)" | php -- --install-dir=/usr/bin/ --filename="$(echo 'Y29tcG9zZXIK' | base64 -d)" \
&& \
composer install;

ENTRYPOINT ["php", "./vendor/bin/phpunit"]
CMD []