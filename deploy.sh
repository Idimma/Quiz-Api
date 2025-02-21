#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
#(php artisan down) || true

# Pull the latest version of the app
#git pull origin production

# Install composer dependencies
composer install  --no-interaction --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize:clear

# Run database migrations
php artisan migrate --force

# Exit maintenance mode
echo "Deployment finished!"


