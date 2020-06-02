#!/usr/bin/env bash
set -euv
cd /home/var/www/php/bfi/docroot
git checkout hotfix-1.2
git fetch
git checkout $CI_COMMIT_SHA
composer install  --no-interaction --optimize-autoloader