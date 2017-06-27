#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/post
ln -s /etc/nginx/sites-available/post /etc/nginx/sites-enabled/post
chown -R www-data:www-data /var/www/post/bootstrap/cache
chown -R www-data:www-data /var/www/post/storage

rm -rf /etc/nginx/sites-enabled/pma
ln -s /etc/nginx/sites-available/pma /etc/nginx/sites-enabled/pma
