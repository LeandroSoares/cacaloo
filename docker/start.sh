#!/bin/sh

# Aguardar MariaDB ficar disponível
echo "Aguardando MariaDB..."
while ! nc -z mariadb 3306; do
  sleep 1
done

echo "MariaDB está disponível!"

# Instalar dependências se o vendor não existir ou estiver vazio
if [ ! -d "vendor" ] || [ -z "$(ls -A vendor 2>/dev/null)" ]; then
    echo "Instalando dependências do Composer..."
    composer install --no-dev --optimize-autoloader
fi

# Instalar dependências Node e compilar assets se necessário
if [ ! -d "node_modules" ] || [ -z "$(ls -A node_modules 2>/dev/null)" ]; then
    echo "Instalando dependências do NPM..."
    npm install
fi

if [ ! -d "public/build" ]; then
    echo "Compilando assets..."
    npm run build
fi

# Gerar chave da aplicação se não existir
if [ ! -f /var/www/html/.env ]; then
    echo "Copiando arquivo .env..."
    cp .env.example .env
fi

if grep -q "APP_KEY=$" .env; then
    echo "Gerando chave da aplicação..."
    php artisan key:generate
fi

# Executar migrações se necessário
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Executando migrações..."
    php artisan migrate --force
fi
# Executar migrações se necessário
if [ "$RUN_MIGRATIONS_FRESH" = "true" ]; then
    echo "Executando migrações..."
    php artisan migrate:fresh --seed --force
fi

# Limpar e otimizar cache
echo "Otimizando caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Iniciando serviços..."

# Iniciar supervisor (que gerencia nginx e php-fpm)
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
