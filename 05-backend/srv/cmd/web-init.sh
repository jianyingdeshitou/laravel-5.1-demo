#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/backend
ln -s /etc/nginx/sites-available/backend /etc/nginx/sites-enabled/backend
chown -R www-data:www-data /var/www/backend/bootstrap/cache
chown -R www-data:www-data /var/www/backend/storage
