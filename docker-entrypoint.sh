#!/bin/bash
set -e

echo "Entrypoint script running as user: $(whoami)" # This should output 'root'

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
# Note: Ensure DB_HOST, DB_USERNAME, DB_PASSWORD are correctly available if needed here.
# The docker-compose environment variables should make them available.
while ! mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    sleep 1
done
echo "MySQL is ready!"

# Set proper permissions at runtime.
# As root, we can ensure storage, bootstrap/cache are owned by root
# but group-writable by www-data (Apache's default run group).
echo "Ensuring correct permissions for storage, bootstrap/cache..."
chown -R root:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R ug+rwx /var/www/html/storage /var/www/html/bootstrap/cache # Sets to 775 (rwxrwxr-x)

# Any other specific directory permissions can be set here.
# For example, if 'public/uploads' needs to be writable:
# mkdir -p /var/www/html/public/uploads
# chown -R root:www-data /var/www/html/public/uploads
# chmod -R ug+rwx /var/www/html/public/uploads

echo "Running Laravel setup commands (as root)..."
php artisan migrate:fresh --force
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Laravel setup complete. Starting Apache."
# Apache will start as root but typically forks worker processes as www-data
# (as configured in /etc/apache2/envvars APACHE_RUN_USER=www-data APACHE_RUN_GROUP=www-data)
exec "$@"