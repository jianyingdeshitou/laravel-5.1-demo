#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/laravel
ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/laravel
chown -R www-data:www-data /var/www/laravel/bootstrap/cache
chown -R www-data:www-data /var/www/laravel/storage

rm -rf /etc/nginx/sites-enabled/pma
ln -s /etc/nginx/sites-available/pma /etc/nginx/sites-enabled/pma
