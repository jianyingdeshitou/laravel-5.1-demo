#!/bin/bash
echo "CREATE USER 'furbook'@'%' IDENTIFIED BY 'furbook'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'furbook'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE furbook;" | mysql -ufurbook -pfurbook

