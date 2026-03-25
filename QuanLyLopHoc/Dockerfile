FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql && \
    a2enmod rewrite
COPY . /var/www/html/
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html
EXPOSE 8080