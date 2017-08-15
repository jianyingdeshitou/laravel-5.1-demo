#!/bin/bash
echo "CREATE USER 'biji'@'%' IDENTIFIED BY 'biji'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'biji'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE biji;" | mysql -ubiji -pbiji

