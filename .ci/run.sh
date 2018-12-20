#!/usr/bin/env bash
set -euv
cd /home/var/www/php/bfi/docroot
php bin/console cache:clear -v --env dev
php bin/console pimcore:deployment:classes-rebuild -v -c --env dev
php bin/console assets:install --symlink --relative
chown -R apache.apache /home/var/www/php/bfi/docroot