# --- STAGE 1: Builder ---
    FROM php:8.2.12-cli-alpine as builder

    # Install build dependencies
    RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        libpng-dev \
        libjpeg-turbo-dev \
        webp-dev \
        libzip-dev \
        oniguruma-dev \
        libxml2-dev
    
    # Compile and install extensions
    RUN docker-php-ext-configure gd --with-jpeg --with-webp \
        && docker-php-ext-install -j$(nproc) \
            pdo_mysql \
            mbstring \
            exif \
            pcntl \
            bcmath \
            gd \
            zip \
            opcache
    
    # --- STAGE 2: Runtime ---
    FROM alpine:3.18 as runtime
    
    # Install only runtime dependencies
    RUN apk add --no-cache \
        php82 \
        php82-fpm \
        php82-opcache \
        php82-pdo \
        php82-pdo_mysql \
        php82-mbstring \
        php82-exif \
        php82-gd \
        php82-zip \
        php82-openssl \
        nginx \
        supervisor
    
    # Copy PHP configurations
    COPY --from=builder /usr/local/etc/php/conf.d/ /etc/php82/conf.d/
    
    # Create non-root user
    RUN adduser -D -u 1000 -g 1000 phpuser
    
    # Application setup
    WORKDIR /var/www
    COPY --chown=phpuser:phpuser . .
    
    # Install Composer (specific version)
    COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer
    
    USER phpuser
    
    # Health check
    HEALTHCHECK --interval=30s --timeout=3s \
        CMD curl -f http://localhost:8080/ping || exit 1
    
    EXPOSE 9000
    CMD ["php-fpm82"]