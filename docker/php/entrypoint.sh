#!/bin/bash

# Switch to the www-data user
su www-data

# Install Composer dependencies
composer install

# Install npm dependencies
npm install

# Run Laravel migrations
php artisan migrate:refresh

# Seed the database
php artisan db:seed

# Run npm dev server in the background
npm run dev -- --host=0.0.0.0 &

# Start Laravel's built-in server in the background
php artisan serve --host=0.0.0.0 --port=8000 &

# Run Laravel Echo server in the background
php artisan reverb:start --host=0.0.0.0 --port=8080 &

# Start the queue worker
php artisan queue:work

