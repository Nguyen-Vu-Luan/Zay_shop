# =========================
# Stage 1: Composer dependencies
# =========================
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts


# =========================
# Stage 2: Node build (frontend assets)
# =========================
FROM node:20 AS frontend
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build


# =========================
# Stage 3: Production image
# =========================
FROM php:8.2-fpm-alpine

# Cài extension PHP cần cho Laravel
RUN docker-php-ext-install pdo pdo_mysql bcmath

# Cài Nginx & Supervisor
RUN apk add --no-cache nginx supervisor curl bash git unzip

WORKDIR /var/www/html

# Copy toàn bộ code
COPY . .

# Copy vendor từ stage 1
COPY --from=vendor /app/vendor ./vendor

# Copy assets build từ stage 2
COPY --from=frontend /app/public/build ./public/build

# Copy config Nginx & Supervisor
COPY ./app/docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./app/docker/supervisord.conf /etc/supervisord.conf

# Copy entrypoint script
COPY ./app/docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Phân quyền cho storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
