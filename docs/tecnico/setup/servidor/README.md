# Setup do Servidor VPS para Laravel (Staging)

## Estrutura de diretórios

```
/var/www/cacaloo/
├── current -> releases/YYYY-MM-DD-HHMMSS  # Symlink para a release ativa
├── releases/                               # Histórico de releases
│   ├── 2025-11-17-120000/                 # Release 1
│   ├── 2025-11-17-150000/                 # Release 2
│   └── ...
└── shared/                                 # Arquivos compartilhados entre releases
    ├── .env                                # Variáveis de ambiente
    └── storage/                            # Storage persistente
        ├── app/
        ├── framework/
        │   ├── cache/
        │   ├── sessions/
        │   └── views/
        └── logs/
```

## 1. Setup inicial do servidor

No servidor SSH, rode:

```bash
# Baixar e executar o script de setup
curl -o setup.sh https://raw.githubusercontent.com/LeandroSoares/cacaloo/v2/docs/setup-servidor/setup-servidor-inicial.sh
chmod +x setup.sh
bash setup.sh
```

Ou copie o arquivo `setup-servidor-inicial.sh` para o servidor e execute:

```bash
bash setup-servidor-inicial.sh
```

O script irá:
- Atualizar o sistema
- Instalar PHP 8.2 com extensões necessárias
- Instalar Nginx
- Instalar Composer
- Instalar Node.js 20 LTS
- Criar estrutura de diretórios
- Ajustar permissões iniciais

## 2. Configurar usuário de deploy

### 2.1. Extrair chave pública (no seu computador local)

```bash
# Na pasta do projeto
cd docs/setup-servidor
bash extrair-chave-publica.sh ../../deploy-stg
```

Isso criará o arquivo `deploy-stg.pub` com a chave pública.

### 2.2. Copiar chave pública para o servidor

```bash
# Copiar chave pública para o servidor
scp ../../deploy-stg.pub root@31.97.170.112:/tmp/
```

### 2.3. Executar script de configuração do usuário (no servidor)

```bash
# No servidor SSH
bash setup-usuario-deploy.sh /tmp/deploy-stg.pub
```

O script irá:
- Criar usuário `deploy` com home em `/home/deploy`
- Adicionar ao grupo `www-data`
- Configurar SSH com a chave pública fornecida
- Criar estrutura de diretórios em `/var/www/cacaloo`
- Ajustar permissões (deploy:www-data)
- Configurar sudoers para comandos específicos (restart nginx, php-fpm, etc.)
- Criar script wrapper `/home/deploy/deploy-wrapper.sh`
- Configurar ACLs para garantir permissões adequadas

### 2.4. Testar conexão SSH com usuário deploy (local)

```bash
ssh -i deploy-stg deploy@31.97.170.112
```

## 3. Configurar Nginx

```bash
# Copiar arquivo de configuração
scp docs/setup-servidor/nginx-cacaloo.conf root@31.97.170.112:/etc/nginx/sites-available/

# No servidor, criar symlink
ln -s /etc/nginx/sites-available/nginx-cacaloo.conf /etc/nginx/sites-enabled/

# Testar configuração
nginx -t

# Recarregar Nginx
systemctl reload nginx
```

## 3. Configurar .env para staging

Edite o arquivo `/var/www/cacaloo/shared/.env` com as configurações de staging:

```bash
nano /var/www/cacaloo/shared/.env
```

Exemplo mínimo:

```env
APP_NAME="Cacaloo Staging"
APP_ENV=stg
APP_KEY=
APP_DEBUG=true
APP_URL=http://31.97.170.112

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cacaloo_stg
DB_USERNAME=cacaloo_user
DB_PASSWORD=senha_segura

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

## 4. Instalar banco de dados (opcional)

Se quiser MySQL/MariaDB local:

```bash
apt install -y mariadb-server
mysql_secure_installation

# Criar banco e usuário
mysql -u root -p
```

```sql
CREATE DATABASE cacaloo_stg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'cacaloo_user'@'localhost' IDENTIFIED BY 'senha_segura';
GRANT ALL PRIVILEGES ON cacaloo_stg.* TO 'cacaloo_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

## 5. Configurar SSH para deploy automático

```bash
# Criar usuário de deploy (opcional, mais seguro)
adduser deploy
usermod -aG www-data deploy

# Adicionar chave pública do GitHub Actions
mkdir -p /root/.ssh
nano /root/.ssh/authorized_keys
# Cole a chave pública gerada (deploy-stg.pub)

# Ajustar permissões
chmod 700 /root/.ssh
chmod 600 /root/.ssh/authorized_keys
```

## 6. Testar deploy manual

```bash
cd /var/www/cacaloo/releases
git clone -b v2 https://github.com/LeandroSoares/cacaloo.git 2025-11-17-120000
cd 2025-11-17-120000

# Instalar dependências
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Criar symlinks para shared
rm -rf storage
ln -s /var/www/cacaloo/shared/storage storage
ln -s /var/www/cacaloo/shared/.env .env

# Gerar chave se necessário
php artisan key:generate

# Rodar migrações
php artisan migrate --force

# Otimizações
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ativar release
ln -sfn /var/www/cacaloo/releases/2025-11-17-120000 /var/www/cacaloo/current

# Ajustar permissões
chown -R www-data:www-data /var/www/cacaloo/current
chmod -R 775 /var/www/cacaloo/shared/storage
```

## 7. Verificar funcionamento

```bash
# Testar PHP-FPM
systemctl status php8.2-fpm

# Testar Nginx
systemctl status nginx
nginx -t

# Acessar no navegador
curl http://31.97.170.112
```

## 8. Logs úteis

```bash
# Logs do Laravel
tail -f /var/www/cacaloo/shared/storage/logs/laravel.log

# Logs do Nginx
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# Logs do PHP-FPM
tail -f /var/log/php8.2-fpm.log
```

## Segredos necessários no GitHub Actions

Configure no repositório (Settings > Secrets):

| Nome | Valor | Descrição |
|------|-------|-----------|
| `STG_SSH_PRIVATE_KEY` | Conteúdo da chave privada `deploy-stg` | Cole todo o conteúdo do arquivo |
| `STG_SSH_HOST` | `31.97.170.112` | IP do servidor VPS |
| `STG_SSH_PORT` | `22` | Porta SSH padrão |
| `STG_SSH_USER` | `deploy` | Usuário criado pelo script |
| `STG_DEPLOY_DIR` | `/var/www/cacaloo` | Diretório base da aplicação |

### Como adicionar STG_SSH_PRIVATE_KEY

No Windows PowerShell:
```powershell
Get-Content deploy-stg | Set-Clipboard
```

No Linux/Mac:
```bash
cat deploy-stg | pbcopy  # Mac
cat deploy-stg | xclip -selection clipboard  # Linux
```

Depois cole no GitHub em: `Settings > Secrets and variables > Actions > New repository secret`

## Melhorias futuras

- [ ] Configurar SSL com Let's Encrypt (certbot)
- [ ] Configurar firewall (ufw)
- [ ] Configurar fail2ban
- [ ] Configurar backups automáticos
- [ ] Configurar monitoramento (logs, uptime)
- [ ] Migrar de root para usuário deploy específico
