#!/bin/bash
echo "CREATE USER 'backend'@'%' IDENTIFIED BY 'backend'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'backend'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE backend;" | mysql -ubackend -pbackend

