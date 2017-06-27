#!/bin/bash
echo "CREATE USER 'post'@'%' IDENTIFIED BY 'post'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'post'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE post;" | mysql -upost -ppost

