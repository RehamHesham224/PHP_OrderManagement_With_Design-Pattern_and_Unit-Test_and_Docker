FROM php:8.1-cli

WORKDIR /app

COPY src/ /app/src/
COPY Tests/ /app/Tests/
COPY phpunit.xml /app/

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock /app/


RUN composer install

CMD [ "php", "./vendor/bin/phpunit", "--configuration", "phpunit.xml" ]


