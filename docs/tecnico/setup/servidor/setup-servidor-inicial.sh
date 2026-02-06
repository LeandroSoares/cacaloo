#!/bin/bash

# Script de setup inicial do servidor VPS para Laravel
# Uso: bash setup-servidor-inicial.sh

set -e

echo "=== Setup inicial do servidor VPS para Laravel ==="

# Cores para output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# 1. Atualizar sistema
echo -e "${BLUE}1. Atualizando sistema...${NC}"
apt update && apt upgrade -y

# 2. Instalar dependências base
echo -e "${BLUE}2. Instalando dependências base...${NC}"
apt install -y software-properties-common curl git unzip

# 3. Adicionar repositório PHP 8.2
echo -e "${BLUE}3. Adicionando repositório PHP 8.2...${NC}"
add-apt-repository -y ppa:ondrej/php
apt update

# 4. Instalar PHP 8.2 e extensões necessárias
echo -e "${BLUE}4. Instalando PHP 8.2 e extensões...${NC}"
apt install -y php8.2-fpm \
    php8.2-cli \
    php8.2-common \
    php8.2-mysql \
    php8.2-zip \
    php8.2-gd \
    php8.2-mbstring \
    php8.2-curl \
    php8.2-xml \
    php8.2-bcmath \
    php8.2-redis \
    php8.2-intl

# 5. Instalar Nginx
echo -e "${BLUE}5. Instalando Nginx...${NC}"
apt install -y nginx

# 6. Instalar Composer
echo -e "${BLUE}6. Instalando Composer...${NC}"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 7. Instalar Node.js e npm
echo -e "${BLUE}7. Instalando Node.js 20 LTS...${NC}"
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs

# 8. Criar estrutura de diretórios
echo -e "${BLUE}8. Criando estrutura de diretórios...${NC}"
mkdir -p /var/www/cacaloo/{releases,shared}
mkdir -p /var/www/cacaloo/shared/storage/{app,framework/{cache,sessions,views},logs}

# 9. Criar arquivo .env vazio
touch /var/www/cacaloo/shared/.env

# 10. Ajustar permissões
echo -e "${BLUE}9. Ajustando permissões...${NC}"
chown -R www-data:www-data /var/www/cacaloo
chmod -R 775 /var/www/cacaloo/shared/storage
chmod 644 /var/www/cacaloo/shared/.env

# 11. Configurar PHP-FPM
echo -e "${BLUE}10. Configurando PHP-FPM...${NC}"
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 64M/' /etc/php/8.2/fpm/php.ini
sed -i 's/post_max_size = .*/post_max_size = 64M/' /etc/php/8.2/fpm/php.ini
sed -i 's/memory_limit = .*/memory_limit = 256M/' /etc/php/8.2/fpm/php.ini

# 12. Configurar Nginx
echo -e "${BLUE}11. Configurando Nginx...${NC}"
rm -f /etc/nginx/sites-enabled/default

# Copiar configuração do Nginx (assumindo que você vai transferir o arquivo)
echo -e "${GREEN}Setup básico concluído!${NC}"
echo ""
echo "Próximos passos:"
echo "1. Copie o arquivo nginx-cacaloo.conf para /etc/nginx/sites-available/"
echo "2. Crie symlink: ln -s /etc/nginx/sites-available/nginx-cacaloo.conf /etc/nginx/sites-enabled/"
echo "3. Configure o arquivo .env em /var/www/cacaloo/shared/.env"
echo "4. Execute nginx -t para testar a configuração"
echo "5. Execute systemctl restart nginx php8.2-fpm"
echo ""
echo "Versões instaladas:"
php -v | head -n 1
composer --version
node -v
npm -v
nginx -v 2>&1 | head -n 1
