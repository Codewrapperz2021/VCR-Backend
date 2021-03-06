FROM php:7.4-fpm-alpine 
RUN docker-php-ext-install pdo pdo_mysql sockets
RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN composer require doctrine/dbal
 WORKDIR /app 
 COPY . . 
 CMD php artisan serve --host=0.0.0.0 
 EXPOSE 8000



