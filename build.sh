#!/bin/sh

#Install PEAR
#sudo apt-get install php-pear

#Install phar-util (https://github.com/koto/phar-util)
#sudo pear channel-discover pear.kotowicz.net
#sudo pear install kotowicz/PharUtil-beta

#Enable Phar writing support in php.ini
#phar.readonly = Off

VERSION=0.1.0-SNAPSHOT

phar-build --ns --src=lib --phar PHP-HAPI-$VERSION.phar
