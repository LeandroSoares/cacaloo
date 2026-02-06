# 🚀 Guia de Deploy e Produção - Sistema Cacaloo

---

## 📋 **ÍNDICE**
1. [Requisitos do Servidor](#requisitos)
2. [Configuração do Ambiente](#ambiente)
3. [Deploy com Docker](#docker)
4. [Configurações de Produção](#produção)
5. [Backup e Manutenção](#backup)
6. [Monitoramento](#monitoramento)

---

## 💻 **REQUISITOS DO SERVIDOR**

### **Especificações Mínimas:**
- **CPU:** 2 cores / 2.0 GHz
- **RAM:** 4 GB (recomendado 8 GB)
- **Armazenamento:** 50 GB SSD
- **Banda:** 100 Mbps

### **Software Necessário:**
- **Docker** 20.10+
- **Docker Compose** 2.0+
- **Git** 2.30+
- **SSL Certificate** (Let's Encrypt recomendado)

### **Portas Utilizadas:**
- **80** - HTTP (redirecionamento)
- **443** - HTTPS
- **3306** - MySQL (interno)
- **6379** - Redis (interno)

---

## 🔧 **CONFIGURAÇÃO DO AMBIENTE**

### **1. Clonar Repositório:**
```bash
# Clone do repositório
git clone https://github.com/LeandroSoares/cacaloo.git
cd cacaloo

# Checkout para branch de produção
git checkout main
```

### **2. Configuração do .env:**
```bash
# Copiar arquivo de exemplo
cp .env.example .env

# Editar configurações
nano .env
```

### **3. Arquivo .env de Produção:**
```env
# Aplicação
APP_NAME="Casa de Caridade Legião de Oxóssi e Ogum"
APP_ENV=production
APP_KEY=base64:SUA_CHAVE_AQUI
APP_DEBUG=false
APP_TIMEZONE=America/Sao_Paulo
APP_URL=https://casadecaridade.com.br

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=cacaloo_prod
DB_USERNAME=cacaloo_user
DB_PASSWORD=SENHA_FORTE_AQUI

# Cache e Session
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Redis
REDIS_HOST=redis
REDIS_PASSWORD=SENHA_REDIS_AQUI
REDIS_PORT=6379

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=contato@casadecaridade.com.br
MAIL_PASSWORD=SENHA_EMAIL_AQUI
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@casadecaridade.com.br
MAIL_FROM_NAME="Casa de Caridade"

# Configurações de Segurança
BCRYPT_ROUNDS=12
SESSION_LIFETIME=120
SESSION_SAME_SITE=strict
SESSION_SECURE_COOKIE=true

# Logs
LOG_CHANNEL=daily
LOG_LEVEL=info
LOG_DAYS=30

# Filesystem
FILESYSTEM_DISK=public
```

---

## 🐳 **DEPLOY COM DOCKER**

### **docker-compose.prod.yml:**
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: docker/Dockerfile.prod
    container_name: cacaloo_app
    restart: unless-stopped
    volumes:
      - ./storage:/var/www/html/storage
      - ./bootstrap/cache:/var/www/html/bootstrap/cache
      - ./public/storage:/var/www/html/public/storage
    networks:
      - cacaloo_network
    depends_on:
      - mysql
      - redis

  nginx:
    image: nginx:alpine
    container_name: cacaloo_nginx
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./public:/var/www/html/public
      - ./docker/nginx/prod.conf:/etc/nginx/nginx.conf
      - ./docker/ssl:/etc/ssl/certs
    networks:
      - cacaloo_network
    depends_on:
      - app

  mysql:
    image: mariadb:10.11
    container_name: cacaloo_mysql
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    volumes:
      - mysql_data:/var/lib/mysql
      - ./docker/mysql/my.cnf:/etc/mysql/my.cnf
    networks:
      - cacaloo_network
    ports:
      - "3306:3306"

  redis:
    image: redis:7-alpine
    container_name: cacaloo_redis
    restart: unless-stopped
    command: redis-server --requirepass ${REDIS_PASSWORD}
    volumes:
      - redis_data:/data
    networks:
      - cacaloo_network

  scheduler:
    build:
      context: .
      dockerfile: docker/Dockerfile.prod
    container_name: cacaloo_scheduler
    restart: unless-stopped
    command: php artisan schedule:work
    volumes:
      - ./storage:/var/www/html/storage
    networks:
      - cacaloo_network
    depends_on:
      - mysql
      - redis

  queue:
    build:
      context: .
      dockerfile: docker/Dockerfile.prod
    container_name: cacaloo_queue
    restart: unless-stopped
    command: php artisan queue:work --daemon
    volumes:
      - ./storage:/var/www/html/storage
    networks:
      - cacaloo_network
    depends_on:
      - mysql
      - redis

volumes:
  mysql_data:
    driver: local
  redis_data:
    driver: local

networks:
  cacaloo_network:
    driver: bridge
```

### **Dockerfile de Produção:**
```dockerfile
# docker/Dockerfile.prod
FROM php:8.4-fpm-alpine

# Instalar dependências do sistema
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    supervisor \
    nginx

# Instalar extensões PHP
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    gd \
    bcmath \
    opcache

# Instalar Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Configurar OPcache
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos da aplicação
COPY . .

# Instalar dependências do Composer (otimizado para produção)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configurar Supervisor
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expor porta
EXPOSE 9000

# Comando de inicialização
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
```

### **Configuração do Nginx:**
```nginx
# docker/nginx/prod.conf
user nginx;
worker_processes auto;
error_log /var/log/nginx/error.log warn;
pid /var/run/nginx.pid;

events {
    worker_connections 1024;
    use epoll;
    multi_accept on;
}

http {
    include /etc/nginx/mime.types;
    default_type application/octet-stream;

    # Logs
    log_format main '$remote_addr - $remote_user [$time_local] "$request" '
                   '$status $body_bytes_sent "$http_referer" '
                   '"$http_user_agent" "$http_x_forwarded_for"';
    access_log /var/log/nginx/access.log main;

    # Performance
    sendfile on;
    tcp_nopush on;
    tcp_nodelay on;
    keepalive_timeout 65;
    types_hash_max_size 2048;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/javascript application/javascript application/json application/xml;

    # Rate limiting
    limit_req_zone $binary_remote_addr zone=login:10m rate=5r/m;
    limit_req_zone $binary_remote_addr zone=api:10m rate=100r/m;

    # SSL Configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_prefer_server_ciphers on;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384;

    # Redirect HTTP to HTTPS
    server {
        listen 80;
        server_name casadecaridade.com.br www.casadecaridade.com.br;
        return 301 https://$server_name$request_uri;
    }

    # HTTPS Server
    server {
        listen 443 ssl http2;
        server_name casadecaridade.com.br www.casadecaridade.com.br;
        root /var/www/html/public;
        index index.php;

        # SSL Certificates
        ssl_certificate /etc/ssl/certs/fullchain.pem;
        ssl_certificate_key /etc/ssl/certs/privkey.pem;

        # Security Headers
        add_header X-Frame-Options "SAMEORIGIN" always;
        add_header X-Content-Type-Options "nosniff" always;
        add_header X-XSS-Protection "1; mode=block" always;
        add_header Referrer-Policy "strict-origin-when-cross-origin" always;
        add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' https:;" always;

        # Laravel Configuration
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        # PHP Processing
        location ~ \.php$ {
            fastcgi_pass cacaloo_app:9000;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
            fastcgi_hide_header X-Powered-By;
        }

        # Static Assets Cache
        location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
            expires 1y;
            add_header Cache-Control "public, immutable";
        }

        # Deny access to sensitive files
        location ~ /\. {
            deny all;
        }

        location ~ /(storage|bootstrap/cache) {
            deny all;
        }

        # Rate limiting for login
        location ~ ^/(login|register) {
            limit_req zone=login burst=10 nodelay;
            try_files $uri $uri/ /index.php?$query_string;
        }
    }
}
```

---

## 🚀 **COMANDOS DE DEPLOY**

### **Script de Deploy Automatizado:**
```bash
#!/bin/bash
# deploy.sh

set -e

echo "🚀 Iniciando deploy do Sistema Cacaloo..."

# 1. Backup do banco atual
echo "📦 Fazendo backup do banco de dados..."
docker exec cacaloo_mysql mysqldump -u root -p${DB_ROOT_PASSWORD} ${DB_DATABASE} > backup_$(date +%Y%m%d_%H%M%S).sql

# 2. Baixar atualizações
echo "⬇️ Baixando atualizações..."
git pull origin main

# 3. Rebuild dos containers
echo "🔨 Reconstruindo containers..."
docker-compose -f docker-compose.prod.yml down
docker-compose -f docker-compose.prod.yml up -d --build

# 4. Aguardar containers iniciarem
echo "⏱️ Aguardando containers..."
sleep 30

# 5. Executar migrations
echo "🗄️ Executando migrations..."
docker exec cacaloo_app php artisan migrate --force

# 6. Limpar e otimizar caches
echo "🧹 Otimizando caches..."
docker exec cacaloo_app php artisan config:cache
docker exec cacaloo_app php artisan route:cache
docker exec cacaloo_app php artisan view:cache
docker exec cacaloo_app php artisan optimize

# 7. Compilar assets
echo "🎨 Compilando assets..."
docker exec cacaloo_app npm run build

# 8. Reiniciar workers
echo "🔄 Reiniciando workers..."
docker exec cacaloo_app php artisan queue:restart

echo "✅ Deploy concluído com sucesso!"
```

### **Comandos Manuais:**
```bash
# Subir ambiente
docker-compose -f docker-compose.prod.yml up -d

# Executar migrations
docker exec cacaloo_app php artisan migrate --force

# Criar usuário sysadmin inicial
docker exec -it cacaloo_app php artisan db:seed --class=RolesAndPermissionsSeeder

# Gerar chave da aplicação
docker exec cacaloo_app php artisan key:generate

# Link simbólico para storage
docker exec cacaloo_app php artisan storage:link

# Limpar todos os caches
docker exec cacaloo_app php artisan optimize:clear

# Cache de produção
docker exec cacaloo_app php artisan optimize
```

---

## 🔒 **CONFIGURAÇÕES DE SEGURANÇA**

### **Configuração do PHP:**
```ini
; docker/php/opcache.ini
[opcache]
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.revalidate_freq=0
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1

[PHP]
expose_php=Off
max_execution_time=60
memory_limit=512M
upload_max_filesize=50M
post_max_size=50M
max_input_vars=3000
```

### **Configuração do MySQL:**
```ini
# docker/mysql/my.cnf
[mysqld]
# Performance
innodb_buffer_pool_size=1G
innodb_log_file_size=256M
innodb_flush_log_at_trx_commit=2
innodb_flush_method=O_DIRECT

# Security
bind-address=0.0.0.0
sql_mode=STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

# Charset
character-set-server=utf8mb4
collation-server=utf8mb4_unicode_ci

# Logs
general_log=0
slow_query_log=1
long_query_time=2
slow_query_log_file=/var/log/mysql/slow.log
```

---

## 💾 **BACKUP E MANUTENÇÃO**

### **Script de Backup Diário:**
```bash
#!/bin/bash
# backup_daily.sh

BACKUP_DIR="/backups/cacaloo"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="cacaloo_prod"

# Criar diretório se não existir
mkdir -p $BACKUP_DIR

# Backup do banco de dados
echo "Fazendo backup do banco de dados..."
docker exec cacaloo_mysql mysqldump -u root -p${DB_ROOT_PASSWORD} $DB_NAME | gzip > $BACKUP_DIR/db_backup_$DATE.sql.gz

# Backup dos arquivos
echo "Fazendo backup dos arquivos..."
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz \
    ./storage \
    ./public/storage \
    ./.env

# Limpar backups antigos (manter 30 dias)
find $BACKUP_DIR -name "*.gz" -mtime +30 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete

echo "Backup concluído: $DATE"
```

### **Cron Job para Backup:**
```bash
# Adicionar ao crontab
crontab -e

# Backup diário às 02:00
0 2 * * * /path/to/backup_daily.sh >> /var/log/backup.log 2>&1

# Limpeza de logs às 03:00
0 3 * * * docker exec cacaloo_app php artisan telescope:prune
```

### **Script de Restauração:**
```bash
#!/bin/bash
# restore.sh

BACKUP_FILE=$1

if [ -z "$BACKUP_FILE" ]; then
    echo "Uso: ./restore.sh backup_file.sql.gz"
    exit 1
fi

echo "⚠️  Restaurando backup: $BACKUP_FILE"
echo "Isso irá sobrescrever os dados atuais!"
read -p "Continuar? (y/N): " -n 1 -r

if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "Restaurando banco de dados..."
    gunzip -c $BACKUP_FILE | docker exec -i cacaloo_mysql mysql -u root -p${DB_ROOT_PASSWORD} ${DB_DATABASE}
    
    echo "Limpando caches..."
    docker exec cacaloo_app php artisan cache:clear
    docker exec cacaloo_app php artisan config:clear
    
    echo "✅ Restauração concluída!"
else
    echo "Operação cancelada."
fi
```

---

## 📊 **MONITORAMENTO**

### **Health Check Script:**
```bash
#!/bin/bash
# health_check.sh

# Verificar containers
echo "Verificando containers..."
docker-compose -f docker-compose.prod.yml ps

# Verificar banco de dados
echo "Verificando banco de dados..."
docker exec cacaloo_mysql mysql -u root -p${DB_ROOT_PASSWORD} -e "SELECT 1" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Banco de dados OK"
else
    echo "❌ Banco de dados com problemas"
fi

# Verificar aplicação
echo "Verificando aplicação..."
RESPONSE=$(curl -s -o /dev/null -w "%{http_code}" https://casadecaridade.com.br)
if [ $RESPONSE -eq 200 ]; then
    echo "✅ Aplicação respondendo OK"
else
    echo "❌ Aplicação com problemas (HTTP $RESPONSE)"
fi

# Verificar espaço em disco
echo "Verificando espaço em disco..."
df -h / | awk 'NR==2{printf "Uso do disco: %s\n", $5}'

# Verificar logs de erro
echo "Verificando logs de erro..."
ERROR_COUNT=$(docker logs cacaloo_app 2>&1 | grep -i error | wc -l)
echo "Erros nas últimas 24h: $ERROR_COUNT"
```

### **Monitoramento com Prometheus (Opcional):**
```yaml
# docker-compose.monitoring.yml
version: '3.8'

services:
  prometheus:
    image: prom/prometheus
    container_name: cacaloo_prometheus
    ports:
      - "9090:9090"
    volumes:
      - ./monitoring/prometheus.yml:/etc/prometheus/prometheus.yml
    networks:
      - cacaloo_network

  grafana:
    image: grafana/grafana
    container_name: cacaloo_grafana
    ports:
      - "3000:3000"
    environment:
      - GF_SECURITY_ADMIN_PASSWORD=admin123
    volumes:
      - grafana_data:/var/lib/grafana
    networks:
      - cacaloo_network

networks:
  cacaloo_network:
    external: true

volumes:
  grafana_data:
```

---

## 🔧 **COMANDOS DE MANUTENÇÃO**

### **Rotina Semanal:**
```bash
# Limpeza de logs
docker exec cacaloo_app php artisan log:clear

# Otimização do banco
docker exec cacaloo_mysql mysql -u root -p${DB_ROOT_PASSWORD} -e "OPTIMIZE TABLE ${DB_DATABASE}.*"

# Limpeza de caches
docker exec cacaloo_app php artisan cache:clear
docker exec cacaloo_app php artisan view:clear

# Atualização de dependências (com cuidado)
docker exec cacaloo_app composer update --no-dev
```

### **Monitoramento de Performance:**
```bash
# Ver uso de recursos
docker stats

# Logs em tempo real
docker logs -f cacaloo_app

# Conectar ao container
docker exec -it cacaloo_app bash

# Verificar configuração do PHP
docker exec cacaloo_app php -i
```

---

**🌿⚔️ Deploy seguro e confiável para o sistema espiritual! ✨**

---

*Última atualização: 19/10/2025*
