# 🚀 Comandos para Deploy no Servidor Linux com composer.phar

## 1. Preparação Inicial do Servidor

### Instalar dependências básicas
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install -y apache2 mysql-server php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-mbstring php8.2-bcmath git curl unzip

# CentOS/RHEL
sudo yum install -y httpd mariadb-server php php-mysqlnd php-xml php-curl php-zip php-gd php-mbstring php-bcmath git curl unzip
```

## 2. Clone do Repositório
```bash
# Ir para o diretório do servidor web
cd /var/www/

# Clonar o repositório
sudo git clone https://github.com/LeandroSoares/cacaloo.git
cd cacaloo
sudo git checkout v2
```

## 3. Baixar e Configurar Composer
```bash
# Baixar composer.phar
curl -sS https://getcomposer.org/installer | php

# Verificar se foi baixado corretamente
ls -la composer.phar

# Testar o composer
php composer.phar --version
```

## 4. Instalar Dependencies
```bash
# Instalar dependencies de produção
sudo -u www-data php composer.phar install --no-dev --optimize-autoloader --no-interaction

# Se der erro de permissão, ajustar antes:
sudo chown -R www-data:www-data /var/www/cacaloo
```

## 5. Configurar Ambiente
```bash
# Copiar template de produção
sudo -u www-data cp .env.example.production .env

# OU usar template padrão e configurar manualmente:
# sudo -u www-data cp .env.example .env

# Editar .env com suas configurações específicas
sudo -u www-data nano .env
```

### Exemplo de .env para produção:
```env
APP_NAME="Casa de Caridade Legião de Oxóssi e Ogum"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://seudominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cacaloo_production
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

## 6. Configurar Aplicação Laravel
```bash
# Gerar chave da aplicação
sudo -u www-data php artisan key:generate

# Executar migrations
sudo -u www-data php artisan migrate --force

# Executar seeders (dados iniciais)
sudo -u www-data php artisan db:seed --force
```

## 🧹 LIMPAR TODOS OS CACHES (MUITO IMPORTANTE!)

### Comandos para limpar cache completamente:
```bash
# 1. Limpar todos os caches do Laravel
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan event:clear

# 2. Limpar cache de autoload do Composer
sudo -u www-data php composer.phar dump-autoload --optimize

# 3. Recriar caches otimizados para produção
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# 4. Limpar cache do OPcache do PHP (se habilitado)
sudo systemctl reload php8.2-fpm
# OU reiniciar Apache
sudo systemctl reload apache2
```

## 7. Configurar Permissões
```bash
# Definir proprietário correto
sudo chown -R www-data:www-data /var/www/cacaloo

# Definir permissões corretas
sudo chmod -R 755 /var/www/cacaloo
sudo chmod -R 775 /var/www/cacaloo/storage
sudo chmod -R 775 /var/www/cacaloo/bootstrap/cache

# Permissões específicas para arquivos sensíveis
sudo chmod 600 /var/www/cacaloo/.env
```

## 8. Configurar Servidor Web

### Para Apache - Virtual Host
```bash
# Criar arquivo de configuração
sudo nano /etc/apache2/sites-available/cacaloo.conf
```

Conteúdo do arquivo:
```apache
<VirtualHost *:80>
    ServerName seudominio.com
    ServerAlias www.seudominio.com
    DocumentRoot /var/www/cacaloo/public
    
    <Directory /var/www/cacaloo/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/cacaloo_error.log
    CustomLog ${APACHE_LOG_DIR}/cacaloo_access.log combined
</VirtualHost>
```

```bash
# Ativar site e módulos
sudo a2ensite cacaloo.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

## 🔄 Script para Atualizações Futuras

Crie um arquivo `update.sh`:
```bash
#!/bin/bash
echo "🔄 Atualizando aplicação..."

cd /var/www/cacaloo

# Atualizar código
sudo -u www-data git pull origin v2

# Atualizar dependencies
sudo -u www-data php composer.phar install --no-dev --optimize-autoloader --no-interaction

# Executar migrations
sudo -u www-data php artisan migrate --force

# LIMPAR TODOS OS CACHES
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan event:clear

# Recriar caches otimizados
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# Reiniciar servidor web
sudo systemctl reload apache2

echo "✅ Atualização concluída!"
```

Dar permissão de execução:
```bash
chmod +x update.sh
```

## 🚨 Troubleshooting - Cache Persistente

Se ainda estiver vendo cache antigo:

### 1. Limpeza Extrema de Cache
```bash
# Parar servidor web temporariamente
sudo systemctl stop apache2

# Remover TODOS os arquivos de cache
sudo rm -rf /var/www/cacaloo/storage/framework/cache/*
sudo rm -rf /var/www/cacaloo/storage/framework/sessions/*
sudo rm -rf /var/www/cacaloo/storage/framework/views/*
sudo rm -rf /var/www/cacaloo/bootstrap/cache/*

# Recriar estrutura de diretórios
sudo -u www-data mkdir -p /var/www/cacaloo/storage/framework/cache/data
sudo -u www-data mkdir -p /var/www/cacaloo/storage/framework/sessions
sudo -u www-data mkdir -p /var/www/cacaloo/storage/framework/views

# Limpar cache do browser (forçar reload)
# Ctrl+F5 ou Ctrl+Shift+R no navegador

# Reiniciar tudo
sudo systemctl start apache2
sudo systemctl restart php8.2-fpm
```

### 2. Verificar Cache do Browser
```bash
# Adicionar headers no Apache para prevenir cache
sudo nano /etc/apache2/sites-available/cacaloo.conf
```

Adicionar dentro do `<Directory>`:
```apache
# Prevenir cache durante desenvolvimento
Header always set Cache-Control "no-cache, no-store, must-revalidate"
Header always set Pragma "no-cache"
Header always set Expires "0"
```

### 3. Verificar OPcache do PHP
```bash
# Verificar se OPcache está habilitado
php -m | grep -i opcache

# Se estiver habilitado, adicionar ao .htaccess:
echo "php_value opcache.revalidate_freq 0" | sudo tee -a /var/www/cacaloo/public/.htaccess
```

## ✅ Comandos de Verificação

```bash
# Verificar se a aplicação está funcionando
curl -I http://localhost

# Verificar logs de erro
sudo tail -f /var/log/apache2/cacaloo_error.log

# Verificar logs do Laravel
sudo tail -f /var/www/cacaloo/storage/logs/laravel.log

# Testar conexão com banco
cd /var/www/cacaloo
sudo -u www-data php artisan tinker
>>> DB::connection()->getPdo();
>>> exit
```
