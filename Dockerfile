FROM node:22-alpine AS node
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx postgresql-dev oniguruma-dev && \
    docker-php-ext-install pdo_pgsql pgsql mbstring bcmath

COPY --from=node /app/public/build /var/www/html/public/build
COPY --from=composer /app/vendor /var/www/html/vendor
COPY . /var/www/html

RUN php artisan package:discover --ansi && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN cat > /etc/nginx/nginx.conf << 'NGINX'
worker_processes auto;
error_log /dev/stderr;
pid /var/run/nginx.pid;

events {
    worker_connections 1024;
}

http {
    include /etc/nginx/mime.types;
    default_type application/octet-stream;
    access_log /dev/stdout;
    sendfile on;
    keepalive_timeout 65;

    server {
        listen 80;
        root /var/www/html/public;
        index index.php index.html;

        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-Content-Type-Options "nosniff";
        charset utf-8;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        error_page 404 /index.php;

        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
}
NGINX

WORKDIR /var/www/html

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan storage:link --force || true && \
    sed -i "s|listen 80|listen ${PORT:-80}|g" /etc/nginx/nginx.conf && \
    php-fpm -D && \
    nginx -g "daemon off;"
