#!/bin/bash
if [ ! -f "/app/artisan" ]; then
    composer create-project --prefer-dist laravel/laravel /app 5.1.*
    echo composer install start ...
    composer install
    echo composer install done!
    npm install
    echo npm install done!
fi
tail -f /var/log/lastlog

