#!/usr/bin/env bash

echo "Starting foo"
php artisan codyfight:bot:run foo &

echo "Starting foo_bar"
php artisan codyfight:bot:run foo_bar &

echo "Starting bar_baz"
php artisan codyfight:bot:run bar_baz &