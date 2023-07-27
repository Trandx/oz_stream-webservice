#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
git fetch origin staging

git reset --hard FETCH_HEAD

git clean -df
#git pull origin staging

#allow permission to super user for composer command
#export COMPOSER_ALLOW_SUPERUSER=1;

# Install composer dependencies
composer install

# Clear the old cache
php artisan cache:clear

# Recreate cache
#php artisan optimize

# Compile npm assets
# npm run prod

# Run database migrations
php artisan migrate:fresh --seed

# Exit maintenance mode
php artisan up

echo "Deployment finished!"
