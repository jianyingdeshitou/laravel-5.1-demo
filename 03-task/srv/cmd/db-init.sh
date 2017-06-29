#!/bin/bash
echo "CREATE USER 'task'@'%' IDENTIFIED BY 'task'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'task'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE task;" | mysql -utask -ptask

