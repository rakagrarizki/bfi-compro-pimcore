#!/usr/bin/env bash
set -euv
cd /home/var/www/php/bfi/docroot
git commit -am "auto commit by gitlab ci for $CI_COMMIT_SHA"
git checkout backend-dev
git fetch
git checkout $CI_COMMIT_SHA
composer install  --no-interaction --optimize-autoloader