FROM php:5.6-apache
MAINTAINER Joschka Seydell

RUN docker-php-ext-install pdo mysql
RUN docker-php-ext-install pdo mysqli

# PHP Modules
RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod expires
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN service apache2 restart

# Installation of Composer (normally development setup only)
RUN apt-get update && apt-get install -y --no-install-recommends git zip
RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/ && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Installation of php dependencies
RUN cd /etc && composer require "everyman/neo4jphp" "dev-master"
RUN cd /etc && composer require slim/slim 2.*
RUN cd /etc && composer require tuupola/slim-jwt-auth:^1.0
RUN cd /etc && composer require firebase/php-jwt 4.*
RUN cd /etc && composer require guzzlehttp/guzzle
RUN cd /etc && composer require phpmailer/phpmailer
RUN cd /etc && composer install --prefer-source --no-interaction