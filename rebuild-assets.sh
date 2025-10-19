#!/bin/bash

# Script para Recompilar Assets
# Casa de Caridade Legião de Oxóssi e Ogum

echo "🏗️  Recompilando assets do Vite..."

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

PROJECT_DIR="/var/www/cacaloo"
cd $PROJECT_DIR

# Verificar se Node.js está instalado
if ! command -v node &> /dev/null; then
    echo -e "${RED}❌ Node.js não está instalado!${NC}"
    echo -e "${YELLOW}💡 Para instalar Node.js:${NC}"
    echo "curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -"
    echo "sudo apt-get install -y nodejs"
    exit 1
fi

echo -e "${YELLOW}📦 Instalando dependências Node.js...${NC}"
sudo -u www-data npm install

echo -e "${YELLOW}🧹 Limpando build anterior...${NC}"
sudo -u www-data rm -rf public/build/*

echo -e "${YELLOW}🏗️  Compilando assets...${NC}"
sudo -u www-data npm run build

echo -e "${YELLOW}🧼 Limpando caches do Laravel...${NC}"
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan config:clear

echo -e "${YELLOW}♻️  Recriando caches...${NC}"
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan view:cache

# Reiniciar servidor web
if systemctl is-active --quiet apache2; then
    echo -e "${YELLOW}🔄 Reiniciando Apache...${NC}"
    sudo systemctl reload apache2
elif systemctl is-active --quiet nginx; then
    echo -e "${YELLOW}🔄 Reiniciando Nginx...${NC}"
    sudo systemctl reload nginx
fi

echo -e "${GREEN}✅ Assets recompilados com sucesso!${NC}"
echo -e "${YELLOW}📝 Verifique se os novos assets estão sendo carregados corretamente.${NC}"
