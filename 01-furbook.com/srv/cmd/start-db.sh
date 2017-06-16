#!/bin/bash
if [ ! -d "$DATADIR/mysql" ]; then
    mysql_install_db
    chown -R mysql:mysql /var/lib/mysql
    service mysql start
    mysqladmin -uroot password "mysql"
    echo "use mysql;update user set host='%' where user='root';flush privileges;" |mysql -uroot -pmysql
fi
service mysql start
tail -f /var/log/mysql/error.log
