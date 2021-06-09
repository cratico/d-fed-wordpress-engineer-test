FROM wordpress:5.5.3-php7.2-apache
RUN a2enmod headers

COPY . /var/www
