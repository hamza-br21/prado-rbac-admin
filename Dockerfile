FROM php:8.2-apache

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensions PHP nécessaires
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    intl \
    opcache

# Activer mod_rewrite
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 80