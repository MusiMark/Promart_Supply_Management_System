FROM php:8.2-apache

# 1. Install SQLite system utilities along with standard dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip

# 2. Change Apache's Document Root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 4. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 5. Copy package definitions explicitly from the Laravel subfolder
COPY Laravel/composer.json Laravel/composer.lock ./

# 6. Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# 7. Copy all code, then lift contents up from the subfolder to the root directory
COPY . .
RUN cp -r Laravel/* . && rm -rf Laravel

# 8. Create an environment file if it does not exist
RUN cp -n .env.example .env || true

# 9. CRITICAL FIX: Ensure the SQLite database file exists and is writable inside the container
RUN mkdir -p database && touch database/database.sqlite

# 10. Optimize the Composer autoloader
RUN composer dump-autoload --no-dev --optimize

# 11. Set proper permissions for storage, cache, AND the database directory
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Render automatically detects the port Apache exposes (80)
EXPOSE 80

# 12. Clear configurations and boot up safely
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    apache2-foreground
