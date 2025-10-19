# Dockerfile para Laravel
FROM php:8.2-fpm-alpine

# Instalar dependências do sistema e extensões PHP
RUN apk add --no-cache \
    curl \
    git \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    mysql-client \
    netcat-openbsd \
    nginx \
    nodejs \
    npm \
    oniguruma-dev \
    supervisor \
    unzip \
    zip \
    && docker-php-ext-install \
    bcmath \
    exif \
    gd \
    mbstring \
    pcntl \
    pdo_mysql \
    zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Configurar permissões e diretórios
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && mkdir -p /etc/supervisor/conf.d \
    && mkdir -p /var/log/supervisor \
    && mkdir -p /var/log/nginx

# Copiar configurações
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf
COPY docker/start.sh /start.sh

# Definir permissões do script
RUN chmod +x /start.sh

# Expor porta
EXPOSE 80

CMD ["/start.sh"]
