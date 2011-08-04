#!/bin/sh

#Install PEAR
#sudo apt-get install php-pear

#Install phar-util (https://github.com/koto/phar-util)
#sudo pear channel-discover pear.kotowicz.net
#sudo pear install kotowicz/PharUtil-beta

#Install phpDocumentor (http://www.phpdoc.org/)
#sudo pear install phpdocumentor

#Enable Phar writing support in php.ini
#phar.readonly = Off

#define version
VERSION=0.4.0

#clean build directory
rm -rf build
mkdir build

#build Phar file
phar-build --ns --src=lib --phar build/PHP-HAPI-$VERSION.phar

#generate phpdocs
phpdoc --directory lib --target build/phpdocs --ignore index.php --title "PHP-HAPI v$VERSION" --sourcecode on --defaultpackagename HAPI
cd build/phpdocs/
zip -r "../PHP-HAPI-$VERSION-phpdocs.zip" *
cd ../..