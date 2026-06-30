FROM php:8.2-apache

# 1. Change Apache's Document Root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 2. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 3. Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# 4. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 5. Copy package definitions first
COPY composer.json composer.loc[k] ./

# 6. Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# 7. Copy the rest of your Laravel application files
COPY . .

# 8. Create an environment file if it does not exist
RUN cp -n .env.example .env || true

# 9. Optimize the Composer autoloader
RUN composer dump-autoload --no-dev --optimize

# 10. Clear ALL hardcoded caches so Laravel reads Render's environment dashboard live
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# 11. Set appropriate permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Render automatically detects the port Apache exposes (80)
EXPOSE 80

CMD ["apache2-foreground"]