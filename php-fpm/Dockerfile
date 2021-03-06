FROM php:7.2-fpm

RUN apt-get update \
 && apt-get install -y \
        git \
        unzip \
        libz-dev \
        aptitude \
        libpng-tools \
        mysql-client \
        libmcrypt-dev \
        libmemcached-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libgconf-2-4 \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd iconv pdo_mysql zip \
 && pecl install xdebug \
 && pecl install memcached \
 && pecl install mcrypt-1.0.1 \
 && docker-php-ext-enable mcrypt \
 && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

# install composer
RUN cd '/' \
 && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer \
 && useradd -m -s /bin/bash nginx

# install node & npm 
RUN apt-get install -y curl wget gnupg \
 && curl -sL https://deb.nodesource.com/setup_10.x | bash -- \
 && apt-get install -y nodejs \
 && npm update -g npm \
 && npm i -g n \
 && npm i -g yarn \
 && n lts \
 && apt-get purge -y nodejs

WORKDIR /opt

