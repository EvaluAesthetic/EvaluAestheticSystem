#!/bin/bash
set -e

# Environment values
#APP_NAME="Laravel"
#APP_ENV="local"
#APP_KEY=""
#APP_DEBUG="true"
#APP_URL="http://localhost"
#DB_CONNECTION="mysql"
#DB_HOST="db"
#DB_PORT="3306"
#DB_DATABASE="evalu"
#DB_USERNAME="root"
#DB_PASSWORD="root"

# Step 1: Pull the latest code (if using version control)
# Uncomment the following line if you use Git
# git clone https://github.com/your-repository/your-laravel-app.git

# Step 2: Navigate to the project directory
# cd your-laravel-app

# Step 3: Create the .env file if it doesn't exist
#if [ ! -f .env ]; then
#  cp .env.example .env
#fi

# Step 4: Update the .env file with the environment variables
#cat <<EOL > .env
#APP_NAME=$APP_NAME
#APP_ENV=$APP_ENV
#APP_KEY=$APP_KEY
#APP_DEBUG=$APP_DEBUG
#APP_URL=$APP_URL
#
#DB_CONNECTION=$DB_CONNECTION
#DB_HOST=$DB_HOST
#DB_PORT=$DB_PORT
#DB_DATABASE=$DB_DATABASE
#DB_USERNAME=$DB_USERNAME
#DB_PASSWORD=$DB_PASSWORD
#EOL

# Step 5: Generate the application key
docker-compose up -d
if [ -z "$APP_KEY" ]; then
  docker-compose exec app php artisan key:generate
  NEW_KEY=$(docker-compose exec app php artisan key:generate --show | tr -d '\r')
  sed -i "s/APP_KEY=/APP_KEY=${NEW_KEY}/" .env
fi

# Step 6: Install Composer dependencies
docker-compose exec app composer install

# Step 7: Run initial database migrations
docker-compose exec app php artisan migrate

# Step 8: Clear and cache configuration
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan view:cache

# Step 9: Rebuild and start Docker containers
docker-compose down
docker-compose up -d --build

# Step 10: Display the status of Docker containers
docker-compose ps
