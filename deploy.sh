#!/bin/bash

# Script de Deploy para Servidor Linux
# Casa de Caridade Legião de Oxóssi e Ogum
# Versão: 1.0

echo "🚀 Iniciando deploy do projeto Laravel..."

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Verificar se o Composer está instalado
if [ ! -f "composer.phar" ]; then
    echo -e "${YELLOW}⚠️  Composer não encontrado. Baixando...${NC}"

    # Baixar Composer
    curl -sS https://getcomposer.org/installer | php

    echo -e "${GREEN}✅ Composer baixado com sucesso!${NC}"
else
    echo -e "${GREEN}✅ Composer já está disponível${NC}"
fi

# Verificar versão do PHP
echo -e "${YELLOW}📋 Verificando versão do PHP...${NC}"
php -v

# Verificar se o Git está instalado
if ! command -v git &> /dev/null; then
    echo -e "${RED}❌ Git não está instalado. Instale com: sudo apt install git${NC}"
    exit 1
fi

# Clonar ou atualizar repositório
REPO_URL="https://github.com/LeandroSoares/cacaloo.git"
PROJECT_DIR="/var/www/cacaloo"

if [ -d "$PROJECT_DIR" ]; then
    echo -e "${YELLOW}📁 Atualizando repositório existente...${NC}"
    cd $PROJECT_DIR
    
    # Detectar branch atual ou usar main como fallback
    CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
    if [ "$CURRENT_BRANCH" == "HEAD" ]; then
        CURRENT_BRANCH="main"
    fi
    
    echo -e "${YELLOW}   Branch atual: $CURRENT_BRANCH${NC}"
    
    git fetch origin
    git checkout $CURRENT_BRANCH
    git pull origin $CURRENT_BRANCH
else
    echo -e "${YELLOW}📥 Clonando repositório...${NC}"
    sudo git clone $REPO_URL $PROJECT_DIR
    cd $PROJECT_DIR
    sudo git checkout main
fi

# Definir permissões
echo -e "${YELLOW}🔐 Configurando permissões...${NC}"
sudo chown -R www-data:www-data $PROJECT_DIR
sudo chmod -R 755 $PROJECT_DIR
sudo chmod -R 775 $PROJECT_DIR/storage
sudo chmod -R 775 $PROJECT_DIR/bootstrap/cache

# Instalar dependências do Composer
echo -e "${YELLOW}📦 Instalando dependências do Composer...${NC}"
cd $PROJECT_DIR
sudo -u www-data php composer.phar install --no-dev --optimize-autoloader --no-interaction

# Verificar se Node.js está instalado para compilar assets
if command -v node &> /dev/null; then
    echo -e "${YELLOW}📦 Instalando dependências Node.js...${NC}"
    sudo -u www-data npm install

    echo -e "${YELLOW}🧹 Limpando build anterior...${NC}"
    sudo -u www-data rm -rf public/build/*

    echo -e "${YELLOW}🏗️  Compilando assets do Vite...${NC}"
    sudo -u www-data npm run build

    echo -e "${GREEN}✅ Assets compilados com sucesso!${NC}"
else
    echo -e "${YELLOW}⚠️  Node.js não encontrado. Verificando assets commitados...${NC}"
    
    if [ -d "public/build" ] && [ -f "public/build/manifest.json" ]; then
        echo -e "${GREEN}✅ Assets pré-compilados encontrados em public/build.${NC}"
        echo -e "${GREEN}   Usando versão commitada do build.${NC}"
    else
        echo -e "${RED}❌ ERRO: Node.js não encontrado e assets não foram commitados!${NC}"
        echo -e "${RED}   Execute 'npm run build' localmente e commite a pasta 'public/build'.${NC}"
        exit 1
    fi
fi

# Copiar arquivo .env se não existir
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}⚙️  Criando arquivo .env...${NC}"

    # Usar template de produção se disponível
    if [ -f ".env.example.production" ]; then
        sudo -u www-data cp .env.example.production .env
        echo -e "${GREEN}✅ Usando template de produção${NC}"
    else
        sudo -u www-data cp .env.example .env
        echo -e "${YELLOW}⚠️  Usando template padrão${NC}"
    fi

    echo -e "${RED}⚠️  IMPORTANTE: Configure o arquivo .env com suas credenciais específicas!${NC}"
else
    echo -e "${GREEN}✅ Arquivo .env já existe${NC}"
fi

# Gerar chave da aplicação se necessário
if ! grep -q "APP_KEY=base64:" .env; then
    echo -e "${YELLOW}🔑 Gerando chave da aplicação...${NC}"
    sudo -u www-data php artisan key:generate
fi

# Executar migrations
echo -e "${YELLOW}🗄️  Executando migrations...${NC}"
sudo -u www-data php artisan migrate --force

# Executar seeders
echo -e "${YELLOW}🌱 Executando seeders...${NC}"
sudo -u www-data php artisan db:seed --force

# Limpar e cachear configurações
echo -e "${YELLOW}🧹 Otimizando aplicação...${NC}"
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# Limpar caches se existirem
echo -e "${YELLOW}🧼 Limpando caches antigos...${NC}"
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear

# Recriar caches
echo -e "${YELLOW}♻️  Recriando caches...${NC}"
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# Verificar se o Apache/Nginx precisa ser reiniciado
if systemctl is-active --quiet apache2; then
    echo -e "${YELLOW}🔄 Reiniciando Apache...${NC}"
    sudo systemctl reload apache2
elif systemctl is-active --quiet nginx; then
    echo -e "${YELLOW}🔄 Reiniciando Nginx...${NC}"
    sudo systemctl reload nginx
fi

echo -e "${GREEN}🎉 Deploy concluído com sucesso!${NC}"
echo -e "${YELLOW}📝 Próximos passos:${NC}"
echo "1. Configure o arquivo .env com suas credenciais de banco"
echo "2. Configure o virtual host do Apache/Nginx"
echo "3. Configure SSL se necessário"
echo "4. Teste a aplicação"
