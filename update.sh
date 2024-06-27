#!/bin/bash
set -e

# Step 1: Pull the latest code (if using version control)
# Uncomment the following line if you use Git
# git pull origin main

# Step 2: Install Composer dependencies
docker-compose exec app composer install

# Step 3: Run database migrations
docker-compose exec app php artisan migrate

# Step 4: Clear and rebuild caches
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan view:cache

# Step 5: Rebuild and restart Docker containers
docker-compose down
docker-compose up -d --build

# Step 6: Verify the status of Docker containers
docker-compose ps
