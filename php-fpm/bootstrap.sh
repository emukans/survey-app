#!/bin/bash

cd /opt/project

# Install dependencies
composer install --no-interaction

# Update database schema
bin/console doctrine:schema:update --force

# Apply latest migrations
php bin/console doctrine:migrations:migrate latest --no-interaction

# Start FPM server
php-fpm
