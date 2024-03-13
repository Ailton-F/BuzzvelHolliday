FROM php:8.2.4-fpm

LABEL authors="Ailton-F"

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Install additional dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip \
    zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    php8.2-fpm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP extensions
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Remove default Nginx configuration
RUN rm /etc/nginx/sites-enabled/default

# Copy Nginx configuration file with rewrite rules
COPY nginx.conf /etc/nginx/sites-available/default

# Enable the Nginx site configuration
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Create necessary directories
RUN mkdir -p /var/www/html

# Set working directory
WORKDIR /var/www/html

# Copy the application code to the container
COPY . /var/www/html

# Expose ports
EXPOSE 80

# Run PHP-FPM and Nginx
CMD service php8.2-fpm start && nginx -g 'daemon off;'
