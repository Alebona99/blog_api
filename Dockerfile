FROM php:7.2-apache

RUN apt-get update & apt-get install -y

RUN docker-php-ext-install mysqli pdo_mysql

RUN mkdir /app \
    && mkdir /app/project \
    && mkdir /app/project/www

COPY . /app/project/www/

RUN pecl install xdebug-2.9.4 && docker-php-ext-enable xdebug

RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini

RUN cp -r /app/project/www/* /var/www/html/.