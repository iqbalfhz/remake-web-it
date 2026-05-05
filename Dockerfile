# =============================================================================
# Stage 1: Build frontend assets (Node.js)
# =============================================================================
FROM node:20-alpine AS assets

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# =============================================================================
# Stage 2: FrankenPHP production image
# =============================================================================
FROM dunglas/frankenphp:php8.4-alpine

LABEL maintainer="IT Tangcity"

# Install required PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    bcmath \
    zip \
    opcache \
    intl \
    pcntl \
    redis \
    exif \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first (layer caching)
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# Copy application source
COPY . .

# Copy built frontend assets from stage 1
COPY --from=assets /app/public/build ./public/build

# Create required directories and set permissions BEFORE composer scripts run
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Run composer post-install scripts
RUN composer dump-autoload --optimize

# Copy and set entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Copy custom Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# FrankenPHP listens on port 80
ENV SERVER_NAME=":80"
ENV APP_ENV=production
ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=warning

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
