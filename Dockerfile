# Use PHP 7.4.26 with Apache
FROM php:7.4.26-apache

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy app code
COPY . /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
