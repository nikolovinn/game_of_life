# Latest stable PHP CLI on Alpine
FROM php:8.4-cli-alpine

# Create non-root user
RUN addgroup -S app && adduser -S -G app app

# Install bash git and unzip - mostly used for composer
RUN apk add --no-cache bash git unzip

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php

# Set the working directory
WORKDIR /app

# Copy the entire project
COPY . .

# Set ownership to app user
RUN chown -R app:app /app


# Drop privileges
USER app

# Install dependencies
RUN composer install --no-interaction --no-progress --prefer-dist


# Default command: run your entry script (you can override in docker-compose)
CMD ["php", "index.php"]
