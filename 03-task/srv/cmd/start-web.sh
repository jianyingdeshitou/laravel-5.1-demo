#!/bin/bash
/cmd/web-init.sh
service nginx start
tail -f /var/log/lastlog

