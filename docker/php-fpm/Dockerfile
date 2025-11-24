# Build stage
FROM php:8.4-fpm-alpine AS base

# Install system dependencies
RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    postgresql-dev \
    icu-dev \
    oniguruma-dev \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    intl \
    opcache \
    mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/backend

# ================================
# Development target
# ================================
FROM base AS development

# Install Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.4.1 \
    && docker-php-ext-enable xdebug

# Copy development PHP configuration
COPY php.ini-development /usr/local/etc/php/conf.d/custom.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Create user for running the application
RUN addgroup -g 1000 appgroup && \
    adduser -D -u 1000 -G appgroup appuser

USER appuser

EXPOSE 9000

CMD ["php-fpm"]

# ================================
# Production target
# ================================
FROM base AS production

# Copy production PHP configuration
COPY php.ini-production /usr/local/etc/php/conf.d/custom.ini

# Create user for running the application
RUN addgroup -g 1000 appgroup && \
    adduser -D -u 1000 -G appgroup appuser

# Clean up unnecessary files
RUN rm -rf /tmp/* /var/cache/apk/*

USER appuser

EXPOSE 9000

CMD ["php-fpm"]
