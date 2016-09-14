#!/bin/bash

composer update --optimize-autoloader --prefer-dist
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console doctrine:database:create