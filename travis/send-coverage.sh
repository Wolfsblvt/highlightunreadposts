#!/bin/bash
#
# Highlight Unread Posts
#
# @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
# @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
# @author Clemens Husung (Wolfsblvt)
#
set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2
GITREPO=$3

if [ "$TRAVIS_PHP_VERSION" == "5.5" -a "$DB" == "mysqli" ]
then
	cd ../$GITREPO
	wget https://scrutinizer-ci.com/ocular.phar
	php ocular.phar code-coverage:upload --format=php-clover ../../phpBB3/build/logs/clover.xml
fi