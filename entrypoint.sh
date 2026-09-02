#!/bin/sh
set -e
 
php artisan config:cache
 
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}