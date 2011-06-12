#!/bin/sh

#Install phar-util via PEAR (https://github.com/koto/phar-util)
#sudo apt-get install php-pear
#sudo pear channel-discover pear.kotowicz.net
#sudo pear install kotowicz/PharUtil-beta

VERSION=0.1.0-SNAPSHOT

phar-build --ns --src=lib --phar PHP-HAPI-$VERSION.phar
