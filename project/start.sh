#!/bin/sh
set -e

# Start script for environments that don't provide heroku-php-apache2
# Uses PHP built-in server to serve the Laravel `public/` folder.
# PORT is provided by the platform (Railway). Default to 8080.

PORT=${PORT:-8080}
php -d variables_order=EGPCS -S 0.0.0.0:${PORT} -t public/
