#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/furbook.com
ln -s /etc/nginx/sites-available/furbook.com /etc/nginx/sites-enabled/furbook.com
chown -R www-data:www-data /var/www/furbook.com/bootstrap/cache
chown -R www-data:www-data /var/www/furbook.com/storage

rm -rf /etc/nginx/sites-enabled/pma
ln -s /etc/nginx/sites-available/pma /etc/nginx/sites-enabled/pma
