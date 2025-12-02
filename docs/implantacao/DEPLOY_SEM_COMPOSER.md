# Guia: Deploy Laravel sem Composer no Servidor

## Opção 1: Instalar Composer no Servidor (Recomendado)

### Para servidores Linux/Ubuntu:
```bash
# Baixar o instalador do Composer
curl -sS https://getcomposer.org/installer | php

# Mover para diretório global
sudo mv composer.phar /usr/local/bin/composer

# Dar permissão de execução
sudo chmod +x /usr/local/bin/composer

# Verificar instalação
composer --version
```

### Para servidores CentOS/RHEL:
```bash
# Instalar curl se necessário
sudo yum install curl

# Baixar e instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

## Opção 2: Incluir vendor/ no Repositório

### Passos:
1. Localmente, execute:
```bash
composer install --no-dev --optimize-autoloader
```

2. Modifique o .gitignore para permitir commit da pasta vendor:
```gitignore
# Comentar esta linha:
# /vendor
```

3. Adicione vendor ao git:
```bash
git add vendor/
git commit -m "build: adiciona dependencies para deploy sem composer"
```

### ⚠️ Desvantagens:
- Repositório fica muito pesado
- Mais difícil de manter
- Problemas com diferentes versões de PHP

## Opção 3: Deploy Manual com FTP

### Passos:
1. Localmente, prepare o build completo:
```bash
composer install --no-dev --optimize-autoloader
npm run build
```

2. Copie estes arquivos via FTP:
- Todos os arquivos PHP
- pasta vendor/ completa
- pasta public/build/ com assets
- .env.example (renomeie para .env no servidor)

## Opção 4: Usar Docker (Se Disponível)

### Dockerfile exemplo:
```dockerfile
FROM php:8.2-apache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar código e instalar dependencies
COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader
```

## Opção 5: Hospedagem com Composer Pré-instalado

### Provedores que incluem Composer:
- DigitalOcean App Platform
- Heroku
- Vercel (com adaptações)
- Railway
- Render

## Configuração Adicional Necessária

### 1. Variáveis de Ambiente (.env):
```env
APP_NAME="Casa de Caridade Legião de Oxóssi e Ogum"
APP_ENV=production
APP_KEY=base64:SUA_CHAVE_AQUI
APP_DEBUG=false
APP_URL=https://seudominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sua_database
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# Cache e Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 2. Permissões no Servidor:
```bash
# Dar permissões para Laravel
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Se usando Apache, configurar virtual host
# Se usando Nginx, configurar server block
```

### 3. Comandos após Deploy:
```bash
# Gerar chave da aplicação
php artisan key:generate

# Executar migrations
php artisan migrate --force

# Executar seeders (se necessário)
php artisan db:seed --force

# Limpar caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Recomendação Final

**Para sua situação específica, recomendo a Opção 2** (incluir vendor no repositório):

1. É mais simples para um primeiro deploy
2. Funciona em qualquer servidor PHP
3. Não requer instalação adicional no servidor
4. Você já tem o ambiente local funcionando
