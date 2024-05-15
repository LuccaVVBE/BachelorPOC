# Use the official PHP image with Apache
FROM php:8.3-apache

# Install any additional PHP extensions if needed
#RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring
RUN docker-php-ext-enable intl mbstring

# Copy your application code to the Apache document root
COPY . /var/www/html/

# Set permissions to allow writing in all folders and subfolders of var/www/html/
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Command to run Apache
CMD ["apache2-foreground"]