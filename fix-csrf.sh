#!/bin/bash

# Script para Corrigir Erro CSRF 419
# Casa de Caridade Legião de Oxóssi e Ogum

echo "🔧 Corrigindo erro CSRF 419..."

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

PROJECT_DIR="/var/www/cacaloo"
cd $PROJECT_DIR

# 1. Gerar nova APP_KEY
echo -e "${YELLOW}🔑 Gerando nova APP_KEY...${NC}"
sudo -u www-data php artisan key:generate --force

# 2. Limpar todos os caches
echo -e "${YELLOW}🧹 Limpando todos os caches...${NC}"
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan view:clear

# Limpar sessões se possível
echo -e "${YELLOW}🗑️ Limpando sessões...${NC}"
sudo -u www-data php artisan session:flush 2>/dev/null || echo "Comando session:flush não disponível"

# 3. Corrigir permissões
echo -e "${YELLOW}🔐 Corrigindo permissões...${NC}"
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# 4. Executar migrations se necessário
echo -e "${YELLOW}🗄️ Verificando migrations...${NC}"
sudo -u www-data php artisan migrate --force

# 5. Recriar caches
echo -e "${YELLOW}♻️ Recriando caches...${NC}"
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# 6. Verificar APP_KEY
echo -e "${YELLOW}🔍 Verificando APP_KEY...${NC}"
APP_KEY_CHECK=$(sudo -u www-data php artisan tinker --execute="echo config('app.key') ? 'OK' : 'FALTA';" 2>/dev/null)
if [[ "$APP_KEY_CHECK" == *"OK"* ]]; then
    echo -e "${GREEN}✅ APP_KEY configurada corretamente${NC}"
else
    echo -e "${RED}❌ APP_KEY não está configurada!${NC}"
    echo -e "${YELLOW}Executando novamente...${NC}"
    sudo -u www-data php artisan key:generate --force
fi

# 7. Limpar cache do PHP se disponível
if command -v opcache_reset &> /dev/null; then
    echo -e "${YELLOW}🔄 Limpando cache do PHP OPcache...${NC}"
    sudo service php8.2-fpm reload 2>/dev/null || echo "PHP-FPM não disponível"
fi

# 8. Reiniciar servidor web
if systemctl is-active --quiet apache2; then
    echo -e "${YELLOW}🔄 Reiniciando Apache...${NC}"
    sudo systemctl restart apache2
    echo -e "${GREEN}✅ Apache reiniciado${NC}"
elif systemctl is-active --quiet nginx; then
    echo -e "${YELLOW}🔄 Reiniciando Nginx e PHP-FPM...${NC}"
    sudo systemctl restart nginx
    sudo systemctl restart php8.2-fpm
    echo -e "${GREEN}✅ Nginx e PHP-FPM reiniciados${NC}"
else
    echo -e "${YELLOW}⚠️ Servidor web não identificado${NC}"
fi

echo -e "${GREEN}🎉 Correção concluída!${NC}"
echo -e "${YELLOW}📝 Próximos passos:${NC}"
echo "1. Aguarde 30 segundos para o servidor reiniciar completamente"
echo "2. Limpe o cache do navegador (Ctrl+Shift+Del)"
echo "3. Teste o login novamente"
echo "4. Se persistir, verifique o arquivo .env e configurações de domínio"

echo -e "${YELLOW}🔍 Para debug adicional:${NC}"
echo "- Logs: tail -f storage/logs/laravel.log"
echo "- Verificar .env: grep -E 'APP_KEY|APP_URL|SESSION_' .env"
