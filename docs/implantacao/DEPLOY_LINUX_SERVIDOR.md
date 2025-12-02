# 🐧 Guia de Deploy em Servidor Linux

## Preparação do Servidor

### 1. Requisitos do Sistema
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install -y apache2 mysql-server php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-mbstring php8.2-bcmath git curl

# CentOS/RHEL
sudo yum install -y httpd mariadb-server php php-mysqlnd php-xml php-curl php-zip php-gd php-mbstring php-bcmath git curl
```

### 2. Instalar Composer
```bash
# Download e instalação
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Verificar instalação
composer --version
```

## Deploy Automático

### Opção 1: Usar o Script de Deploy
```bash
# Baixar e executar o script
wget https://raw.githubusercontent.com/LeandroSoares/cacaloo/v2/deploy.sh
chmod +x deploy.sh
sudo ./deploy.sh
```

### Opção 2: Deploy Manual

#### 1. Clonar Repositório
```bash
# Clonar na pasta do servidor web
sudo git clone https://github.com/LeandroSoares/cacaloo.git /var/www/cacaloo
cd /var/www/cacaloo
sudo git checkout v2
```

#### 2. Configurar Permissões
```bash
sudo chown -R www-data:www-data /var/www/cacaloo
sudo chmod -R 755 /var/www/cacaloo
sudo chmod -R 775 /var/www/cacaloo/storage
sudo chmod -R 775 /var/www/cacaloo/bootstrap/cache
```

#### 3. Instalar Dependencies
```bash
cd /var/www/cacaloo
sudo -u www-data composer install --no-dev --optimize-autoloader
```

#### 4. Configurar Ambiente
```bash
# Copiar template de produção
sudo -u www-data cp .env.example.production .env

# Editar configurações específicas (banco de dados, etc.)
sudo -u www-data nano .env

# Gerar chave da aplicação
sudo -u www-data php artisan key:generate
```

#### 5. Configurar Banco de Dados
```bash
# Conectar ao MySQL
sudo mysql -u root -p

# Criar banco e usuário
CREATE DATABASE cacaloo_production;
CREATE USER 'cacaloo_user'@'localhost' IDENTIFIED BY 'sua_senha_segura';
GRANT ALL PRIVILEGES ON cacaloo_production.* TO 'cacaloo_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 6. Executar Migrations e Seeders
```bash
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan db:seed --force
```

#### 7. Otimizar Aplicação
```bash
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
```

## Configuração do Apache

### Virtual Host (/etc/apache2/sites-available/cacaloo.conf)
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

### Habilitar Site
```bash
sudo a2ensite cacaloo.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

## Configuração do Nginx (Alternativa)

### Server Block (/etc/nginx/sites-available/cacaloo)
```nginx
server {
    listen 80;
    server_name seudominio.com www.seudominio.com;
    root /var/www/cacaloo/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Habilitar Site
```bash
sudo ln -s /etc/nginx/sites-available/cacaloo /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

## SSL com Certbot (Let's Encrypt)

```bash
# Instalar Certbot
sudo apt install certbot python3-certbot-apache  # Para Apache
# ou
sudo apt install certbot python3-certbot-nginx   # Para Nginx

# Obter certificado
sudo certbot --apache -d seudominio.com -d www.seudominio.com  # Apache
# ou
sudo certbot --nginx -d seudominio.com -d www.seudominio.com   # Nginx

# Configurar renovação automática
sudo crontab -e
# Adicionar linha:
0 12 * * * /usr/bin/certbot renew --quiet
```

## Atualizações Futuras

### Script de Atualização (update.sh)
```bash
#!/bin/bash
cd /var/www/cacaloo
sudo -u www-data git pull origin v2
sudo -u www-data composer install --no-dev --optimize-autoloader
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo systemctl reload apache2  # ou nginx
```

## Monitoramento e Logs

### Verificar Logs
```bash
# Logs do Laravel
tail -f /var/www/cacaloo/storage/logs/laravel.log

# Logs do Apache
tail -f /var/log/apache2/cacaloo_error.log

# Logs do Nginx
tail -f /var/log/nginx/error.log
```

### Backup do Banco
```bash
# Script de backup diário
#!/bin/bash
mysqldump -u cacaloo_user -p cacaloo_production > /backup/cacaloo_$(date +%Y%m%d).sql
```

## Troubleshooting

### Problemas Comuns

1. **Erro 500:** Verificar logs e permissões
2. **Composer não encontrado:** Verificar instalação do Composer
3. **Erro de banco:** Verificar credenciais no .env
4. **Assets não carregam:** Verificar se public/build/ está presente

### Comandos Úteis
```bash
# Verificar status dos serviços
sudo systemctl status apache2
sudo systemctl status mysql

# Verificar configuração do PHP
php -m  # Módulos instalados
php --ini  # Arquivos de configuração

# Testar conectividade do banco
php artisan tinker
>>> DB::connection()->getPdo();
```
