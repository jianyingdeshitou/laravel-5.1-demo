#!/bin/bash
echo "CREATE USER 'rbac'@'%' IDENTIFIED BY 'rbac'" | mysql -uroot
echo "GRANT ALL PRIVILEGES ON *.* TO 'rbac'@'%' WITH GRANT OPTION" | mysql -uroot
echo "CREATE DATABASE rbac;" | mysql -urbac -prbac

