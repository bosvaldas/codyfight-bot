#!/usr/bin/env bash

echo "Stopping all bots"

pkill -f "php artisan codyfight:bot:run"