#!/bin/sh
set -e

echo "==> [HFST-WBMS] Starting application container..."

# 1. Ensure storage and bootstrap/cache directories exist
mkdir -p /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/cache \
         /var/www/html/storage/logs \
         /var/www/html/storage/app/public \
         /var/www/html/bootstrap/cache

# 2. Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 3. Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
    if [ -f /var/www/html/.env.example ]; then
        echo "==> [HFST-WBMS] Copying .env.example to .env..."
        cp /var/www/html/.env.example /var/www/html/.env
    fi
fi

# 4. Generate APP_KEY if empty
if [ -f /var/www/html/.env ] && ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    echo "==> [HFST-WBMS] Generating APP_KEY..."
    php artisan key:generate --force || true
fi

# 5. Create storage symlink
php artisan storage:link --quiet || true

# 6. Wait for MySQL Database (if DB_HOST is set)
if [ -n "$DB_HOST" ]; then
    echo "==> [HFST-WBMS] Waiting for database at $DB_HOST:${DB_PORT:-3306}..."
    max_tries=30
    count=0
    until php -r "
        \$host = getenv('DB_HOST');
        \$port = getenv('DB_PORT') ?: '3306';
        \$db   = getenv('DB_DATABASE');
        \$user = getenv('DB_USERNAME');
        \$pass = getenv('DB_PASSWORD');
        try {
            new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass, [PDO::ATTR_TIMEOUT => 2]);
            exit(0);
        } catch (Exception \$e) {
            exit(1);
        }
    " 2>/dev/null; do
        count=$((count + 1))
        if [ $count -gt $max_tries ]; then
            echo "==> [HFST-WBMS] Warning: Database connection timed out. Proceeding anyway..."
            break
        fi
        sleep 1
    done
    echo "==> [HFST-WBMS] Database reachable!"
fi

# 7. Auto-run migrations if requested or enabled
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "==> [HFST-WBMS] Running database migrations..."
    php artisan migrate --force --isolated || true
fi

# 8. Optimize caching in production
if [ "$APP_ENV" = "production" ]; then
    echo "==> [HFST-WBMS] Optimizing application for production..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

echo "==> [HFST-WBMS] Application ready. Starting supervisor..."
exec "$@"
