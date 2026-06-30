FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 1. Copy only package definitions first (Optimizes Docker layer caching)
COPY composer.json composer.lock ./

# 2. Install dependencies without running project-specific scripts yet
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# 3. Copy the rest of the application files
COPY . .

# 4. Create an environment file if it does not exist (Prevents Artisan boot crashes)
RUN cp -n .env.example .env || true

# 5. Optimize the Composer autoloader now that all files are copied
RUN composer dump-autoload --no-dev --optimize

# 6. Clear Laravel configuration caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

CMD ["php-fpm"]
