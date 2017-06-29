#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/task
ln -s /etc/nginx/sites-available/task /etc/nginx/sites-enabled/task
chown -R www-data:www-data /var/www/task/bootstrap/cache
chown -R www-data:www-data /var/www/task/storage

rm -rf /etc/nginx/sites-enabled/pma
ln -s /etc/nginx/sites-available/pma /etc/nginx/sites-enabled/pma
