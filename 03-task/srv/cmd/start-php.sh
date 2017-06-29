#!/bin/bash
service php5-fpm start
tail -f /var/log/php5-fpm.log

