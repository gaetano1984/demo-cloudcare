#!/bin/sh
set -e

cd /var/www/html/laravel && composer install
cd /var/www/html/laravel && cp .env.example .env
cd /var/www/html/laravel && php artisan key:generate
cd /var/www/html/laravel && php artisan migrate:install
cd /var/www/html/laravel && php artisan migrate

cd /var/www/hmtml/laravel && php artisan db:seed --class DefaultUser

php-fpm