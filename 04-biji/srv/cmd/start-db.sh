#!/bin/bash
if [ ! -d "/var/lib/mysql" ]; then
    mysql_install_db
    chown -R mysql:mysql /var/lib/mysql
    service mysql start
    /cmd/db-init.sh
fi
service mysql start
tail -f /var/log/mysql/error.log
