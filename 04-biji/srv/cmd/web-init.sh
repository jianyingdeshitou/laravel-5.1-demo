#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/biji
ln -s /etc/nginx/sites-available/biji /etc/nginx/sites-enabled/biji
chown -R www-data:www-data /var/www/biji/bootstrap/cache
chown -R www-data:www-data /var/www/biji/storage
