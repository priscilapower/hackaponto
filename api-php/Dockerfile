FROM php:7.2-apache

MAINTAINER BUGFIX

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN docker-php-ext-install pdo_mysql \
&& a2enmod rewrite \
&& echo "ServerName localhost" >> /etc/apache2/apache2.conf \
&& sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN service apache2 stop \
&& service apache2 start
