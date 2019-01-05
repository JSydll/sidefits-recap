FROM php:5.6-apache
MAINTAINER Joschka Seydell
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"