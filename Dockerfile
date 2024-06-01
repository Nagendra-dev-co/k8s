# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Install PHP extensions required by the application
RUN docker-php-ext-install mysqli

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
