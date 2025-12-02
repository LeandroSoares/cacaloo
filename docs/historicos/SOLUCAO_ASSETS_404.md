# 🚨 Solucionando Erros 404 de Assets

## Problema
Erros como:
```
app-WttZDXC5.js:1  Failed to load resource: the server responded with a status of 404
app-Doajhxbc.css:1  Failed to load resource: the server responded with a status of 404
```

## Causas Possíveis
1. **Assets não compilados no servidor**
2. **Caches desatualizados**
3. **Node.js não instalado no servidor**
4. **Permissões incorretas nos arquivos**

## Soluções

### 1. Recompilar Assets no Servidor
```bash
# Usar o script automático
cd /var/www/cacaloo
sudo bash rebuild-assets.sh
```

### 2. Solução Manual Passo-a-Passo

#### Instalar Node.js (se necessário)
```bash
# Ubuntu/Debian
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Verificar instalação
node --version
npm --version
```

#### Recompilar Assets
```bash
cd /var/www/cacaloo

# Instalar dependências
sudo -u www-data npm install

# Limpar build anterior
sudo -u www-data rm -rf public/build/*

# Compilar assets
sudo -u www-data npm run build
```

#### Limpar Todos os Caches
```bash
# Caches do Laravel
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear

# Recriar caches
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan route:cache
```

#### Verificar Permissões
```bash
sudo chown -R www-data:www-data /var/www/cacaloo/public/build
sudo chmod -R 755 /var/www/cacaloo/public/build
```

#### Reiniciar Servidor Web
```bash
# Apache
sudo systemctl reload apache2

# Nginx
sudo systemctl reload nginx
```

### 3. Verificar se Assets Foram Gerados
```bash
ls -la /var/www/cacaloo/public/build/
ls -la /var/www/cacaloo/public/build/assets/

# Deve mostrar arquivos como:
# app-xxxxxxxx.js
# app-xxxxxxxx.css
# manifest.json
```

### 4. Verificar o Manifest
```bash
cat /var/www/cacaloo/public/build/manifest.json

# Deve conter algo como:
# {
#   "resources/css/app.css": {
#     "file": "assets/app-xxxxxxxx.css",
#     "src": "resources/css/app.css",
#     "isEntry": true
#   },
#   "resources/js/app.js": {
#     "file": "assets/app-xxxxxxxx.js",
#     "name": "app",
#     "src": "resources/js/app.js",
#     "isEntry": true
#   }
# }
```

### 5. Forçar Atualização do Browser
- **Ctrl + F5** (Windows/Linux)
- **Cmd + Shift + R** (Mac)
- **Limpar cache do navegador**

### 6. Verificar Virtual Host
Certifique-se de que seu virtual host está configurado corretamente:

```apache
# Apache
<VirtualHost *:80>
    ServerName seudominio.com
    DocumentRoot /var/www/cacaloo/public
    
    <Directory /var/www/cacaloo/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    # Para assets estáticos
    <Directory /var/www/cacaloo/public/build>
        ExpiresActive On
        ExpiresDefault "access plus 1 year"
    </Directory>
</VirtualHost>
```

```nginx
# Nginx
server {
    listen 80;
    server_name seudominio.com;
    root /var/www/cacaloo/public;
    
    index index.php index.html;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # Para assets estáticos
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Comandos Rápidos para Solução

```bash
# Solução completa em uma linha
cd /var/www/cacaloo && sudo -u www-data npm install && sudo -u www-data rm -rf public/build/* && sudo -u www-data npm run build && sudo -u www-data php artisan cache:clear && sudo -u www-data php artisan view:clear && sudo -u www-data php artisan config:cache && sudo -u www-data php artisan view:cache && sudo systemctl reload apache2
```

## Prevenção
- Sempre execute `npm run build` após mudanças no CSS/JS
- Mantenha Node.js atualizado no servidor
- Configure deploy automático que compile assets
- Use controle de versão para assets quando possível
