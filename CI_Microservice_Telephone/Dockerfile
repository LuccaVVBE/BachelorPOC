# Use the official PHP image with Apache
FROM php:8.3-apache

# Install any additional PHP extensions if needed
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your application code to the Apache document root
COPY ./CI_Microservice_Telephone /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Command to run Apache
CMD ["apache2-foreground"]