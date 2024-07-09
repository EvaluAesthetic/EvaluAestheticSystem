#!/bin/bash
set -e

# Environment values
APP_NAME="Laravel"
APP_ENV="local"
APP_KEY=""
APP_DEBUG="true"
APP_URL="http://localhost"
DB_CONNECTION="mysql"
DB_HOST="db"
DB_PORT="3306"
DB_DATABASE="evalu"
DB_USERNAME="root"
DB_PASSWORD="root"

echo "Step 1: Pulling the latest code (if using version control)"
# Uncomment the following line if you use Git
# git clone https://github.com/your-repository/your-laravel-app.git

# echo "Step 2: Navigating to the project directory"
# Uncomment and modify the following line if needed
# cd your-laravel-app

echo "Step 3: Creating the .env file if it doesn't exist"
if [ ! -f .env ]; then
  cp .env.example .env
  echo ".env file created."
else
  echo ".env file already exists."
fi

echo "Step 4: Updating the .env file with the environment variables"
cat <<EOL > .env
APP_NAME=$APP_NAME
APP_ENV=$APP_ENV
APP_KEY=$APP_KEY
APP_DEBUG=$APP_DEBUG
APP_URL=$APP_URL

DB_CONNECTION=$DB_CONNECTION
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_DATABASE=$DB_DATABASE
DB_USERNAME=$DB_USERNAME
DB_PASSWORD=$DB_PASSWORD
EOL
echo ".env file updated."

echo "Step 5: Bringing up Docker containers"
docker-compose up -d || { echo 'Failed to bring up Docker containers' ; exit 1; }

echo "Step 6: Installing Composer dependencies"
docker-compose exec app composer install || { echo 'Failed to install Composer dependencies' ; exit 1; }

echo "Generating the application key"
if [ -z "$APP_KEY" ]; then
  NEW_KEY=$(docker-compose exec app php artisan key:generate --show | tr -d '\r') || { echo 'Failed to generate application key' ; exit 1; }
  echo "Generated application key: $NEW_KEY"
  if [ -n "$NEW_KEY" ]; then
    # Ensure NEW_KEY does not contain any unexpected characters
    NEW_KEY_CLEAN=$(echo $NEW_KEY | tr -d '\r\n')
    echo "Cleaned application key: $NEW_KEY_CLEAN"
    # Use an alternative method to update the .env file
    awk -v newkey="$NEW_KEY_CLEAN" 'BEGIN{FS=OFS="="} /^APP_KEY=/{$2=newkey}1' .env > .env.tmp && mv .env.tmp .env
    echo "Application key generated and updated in .env file."
  else
    echo "Failed to retrieve the new application key."
    exit 1
  fi
fi

echo "Step 7: Running initial database migrations"
docker-compose exec app php artisan migrate || { echo 'Failed to run database migrations' ; exit 1; }

echo "Step 8: Clearing and caching configuration"
docker-compose exec app php artisan config:clear || { echo 'Failed to clear config cache' ; exit 1; }
docker-compose exec app php artisan config:cache || { echo 'Failed to cache config' ; exit 1; }
docker-compose exec app php artisan route:clear || { echo 'Failed to clear route cache' ; exit 1; }
docker-compose exec app php artisan route:cache || { echo 'Failed to cache routes' ; exit 1; }
docker-compose exec app php artisan view:clear || { echo 'Failed to clear view cache' ; exit 1; }
docker-compose exec app php artisan view:cache || { echo 'Failed to cache views' ; exit 1; }

echo "Step 9: Rebuilding and starting Docker containers"
docker-compose down
docker-compose up -d --build

echo "Step 10: Displaying the status of Docker containers"
docker-compose ps
