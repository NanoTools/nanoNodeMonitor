#!/bin/bash

# set the config directory
monitordir="/opt/nanoNodeMonitor"

# create config dir
mkdir -p "${monitordir}"

# check for config file
if [ ! -f "${monitordir}/config.php" ]; then
        echo "Config File not found, adding default."
        cp "/var/www/html/modules/config.sample.php" "${monitordir}/config.php"
fi

# create config symlink
ln -s $monitordir/config.php /var/www/html/modules/config.php

# change folder rights so www-data can read
chmod 755 /opt

# start apache
apache2-foreground