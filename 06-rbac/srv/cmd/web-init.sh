#!/bin/bash
rm -rf /etc/nginx/sites-enabled/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

rm -rf /etc/nginx/sites-enabled/rbac
ln -s /etc/nginx/sites-available/rbac /etc/nginx/sites-enabled/rbac
chown -R www-data:www-data /var/www/rbac/bootstrap/cache
chown -R www-data:www-data /var/www/rbac/storage
