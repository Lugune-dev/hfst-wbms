# ========================================================
# Stage 1: Install PHP Dependencies with Composer
# ========================================================
FROM composer:2 AS vendor
WORKDIR /app

# Copy dependency manifests
COPY composer.json composer.lock ./

# Install vendor dependencies without dev packages and scripts
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --ignore-platform-reqs \
    --no-scripts \
    --no-autoloader

# Copy application source to generate optimized classmap
COPY . .
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# ========================================================
# Stage 2: Build Frontend Assets with Node
# ========================================================
FROM node:20-alpine AS frontend
WORKDIR /app

# Copy dependency manifests
COPY package*.json ./
RUN npm ci

# Copy vendor from vendor stage so Tailwind can resolve Filament theme CSS
COPY --from=vendor /app/vendor /app/vendor
COPY resources/ resources/
COPY app/ app/
COPY public/ public/
COPY vite.config.js ./

# Compile production assets into public/build
RUN npm run build

# ========================================================
# Stage 3: Production PHP-FPM + Nginx Application
# ========================================================
FROM php:8.3-fpm-alpine

LABEL maintainer="Hope for Students Tanzania <info@hfst.co.tz>" \
      description="Production container for HFST-WBMS (Laravel 11, Filament 3, PHP 8.3)"

# Install system dependencies & runtime libraries
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    sqlite-dev \
    fontconfig \
    ttf-dejavu

# Install & configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo_mysql \
        pdo_sqlite \
        zip \
        intl \
        pcntl \
        bcmath \
        exif \
        opcache

# Copy Composer binary from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files (excluding .dockerignore)
COPY . /var/www/html

# Copy pre-installed vendor from vendor stage
COPY --from=vendor /app/vendor /var/www/html/vendor

# Copy compiled frontend assets from frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Copy configurations
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-hfst.ini
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Create required runtime directories and set proper permissions
RUN mkdir -p /run/nginx \
             /var/log/supervisor \
             /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/storage/framework/cache \
             /var/www/html/storage/logs \
             /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod +x /usr/local/bin/entrypoint.sh

# Expose HTTP port
EXPOSE 80

# Healthcheck
HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD curl -f http://127.0.0.1/ || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
