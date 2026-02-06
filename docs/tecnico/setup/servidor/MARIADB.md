# Instalação do MariaDB no Servidor Staging

## Opção 1: Usando o script automatizado (RECOMENDADO)

### 1. Copiar script para o servidor

```bash
# Do seu computador local
scp docs/setup-servidor/setup-mariadb.sh root@31.97.170.112:/tmp/
```

### 2. Executar no servidor

```bash
# Conectar via SSH
ssh root@31.97.170.112

# Executar script
cd /tmp
chmod +x setup-mariadb.sh
bash setup-mariadb.sh
```

O script vai:
- ✅ Instalar MariaDB Server
- ✅ Gerar senhas seguras automaticamente
- ✅ Criar banco `cacaloo_stg` com charset UTF8MB4
- ✅ Criar usuário `cacaloo_user` com permissões
- ✅ Configurar otimizações para Laravel
- ✅ Atualizar `/var/www/cacaloo/shared/.env` automaticamente
- ✅ Salvar credenciais em `/root/.mariadb_credentials`

### 3. Guardar as credenciais

O script mostrará as credenciais geradas. **COPIE E GUARDE EM LOCAL SEGURO!**

Exemplo de saída:
```
CREDENCIAIS (GUARDE EM LOCAL SEGURO):
----------------------------------------
Banco de dados: cacaloo_stg
Usuário: cacaloo_user
Senha: aB3dEf7gH9jK2mN4pQ6rS8tU

Root password: xY9wV7uT5sR3qP1oN8mL6kJ4
```

---

## Opção 2: Instalação manual

Se preferir fazer passo a passo manualmente:

### 1. Instalar MariaDB

```bash
apt update
apt install -y mariadb-server mariadb-client
```

### 2. Iniciar serviço

```bash
systemctl start mariadb
systemctl enable mariadb
systemctl status mariadb
```

### 3. Configurar segurança

```bash
mysql_secure_installation
```

Responda:
- Enter current password: `[Enter]` (sem senha inicialmente)
- Switch to unix_socket authentication: `N`
- Change root password: `Y` → Digite uma senha forte
- Remove anonymous users: `Y`
- Disallow root login remotely: `Y`
- Remove test database: `Y`
- Reload privilege tables: `Y`

### 4. Criar banco e usuário

```bash
mysql -u root -p
```

Dentro do MySQL:

```sql
-- Criar banco
CREATE DATABASE cacaloo_stg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Criar usuário (ALTERE A SENHA!)
CREATE USER 'cacaloo_user'@'localhost' IDENTIFIED BY 'SUA_SENHA_FORTE_AQUI';

-- Dar permissões
GRANT ALL PRIVILEGES ON cacaloo_stg.* TO 'cacaloo_user'@'localhost';

-- Aplicar mudanças
FLUSH PRIVILEGES;

-- Verificar
SHOW DATABASES;
SELECT User, Host FROM mysql.user;

-- Sair
EXIT;
```

### 5. Testar conexão

```bash
mysql -u cacaloo_user -p cacaloo_stg
```

Digite a senha que você definiu. Se conectar, está funcionando!

### 6. Configurar .env

Edite `/var/www/cacaloo/shared/.env`:

```bash
nano /var/www/cacaloo/shared/.env
```

Adicione/atualize:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cacaloo_stg
DB_USERNAME=cacaloo_user
DB_PASSWORD=SUA_SENHA_FORTE_AQUI
```

Salve com `Ctrl+O`, `Enter`, `Ctrl+X`.

---

## Após a instalação (ambas opções)

### 1. Rodar migrações

```bash
cd /var/www/cacaloo/current
php artisan migrate --force
```

### 2. Rodar seeders (se necessário)

```bash
php artisan db:seed --force
```

### 3. Verificar tabelas

```bash
mysql -u cacaloo_user -p cacaloo_stg -e "SHOW TABLES;"
```

---

## Comandos úteis

### Backup do banco

```bash
# Backup completo
mysqldump -u root -p cacaloo_stg > /root/backup_cacaloo_$(date +%Y%m%d_%H%M%S).sql

# Backup compactado
mysqldump -u root -p cacaloo_stg | gzip > /root/backup_cacaloo_$(date +%Y%m%d_%H%M%S).sql.gz
```

### Restaurar backup

```bash
# De arquivo SQL
mysql -u root -p cacaloo_stg < backup_cacaloo_20251117.sql

# De arquivo compactado
gunzip < backup_cacaloo_20251117.sql.gz | mysql -u root -p cacaloo_stg
```

### Ver logs

```bash
# Logs gerais
tail -f /var/log/mysql/error.log

# Queries lentas (se configurado)
tail -f /var/log/mysql/slow-query.log
```

### Monitorar processos

```bash
mysql -u root -p -e "SHOW PROCESSLIST;"
```

### Ver uso de espaço

```bash
mysql -u root -p -e "
SELECT 
    table_schema AS 'Database',
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size (MB)'
FROM information_schema.tables
GROUP BY table_schema;
"
```

---

## Troubleshooting

### Erro: "Can't connect to MySQL server"

```bash
# Verificar se está rodando
systemctl status mariadb

# Iniciar se parado
systemctl start mariadb

# Ver logs
journalctl -u mariadb -n 50
```

### Erro: "Access denied for user"

```bash
# Resetar senha root (se esqueceu)
systemctl stop mariadb
mysqld_safe --skip-grant-tables &
mysql -u root

# Dentro do MySQL:
FLUSH PRIVILEGES;
ALTER USER 'root'@'localhost' IDENTIFIED BY 'nova_senha';
EXIT;

# Reiniciar normalmente
killall mysqld
systemctl start mariadb
```

### Otimizar performance

```bash
# Ver variáveis atuais
mysql -u root -p -e "SHOW VARIABLES LIKE '%buffer%';"

# Editar configuração
nano /etc/mysql/mariadb.conf.d/50-server.cnf

# Reiniciar
systemctl restart mariadb
```

---

## Segurança adicional (opcional)

### 1. Firewall - apenas localhost

```bash
# MariaDB já está configurado para aceitar apenas localhost por padrão
# Confirme em:
grep bind-address /etc/mysql/mariadb.conf.d/50-server.cnf

# Deve mostrar:
# bind-address = 127.0.0.1
```

### 2. Rotação de senhas

```bash
# Alterar senha do usuário
mysql -u root -p
ALTER USER 'cacaloo_user'@'localhost' IDENTIFIED BY 'NOVA_SENHA';
FLUSH PRIVILEGES;
EXIT;

# Atualizar .env
nano /var/www/cacaloo/shared/.env
```

### 3. Backup automático (cron)

```bash
# Criar script de backup
cat > /root/backup-mysql.sh <<'EOF'
#!/bin/bash
mysqldump -u root -p'SUA_SENHA_ROOT' cacaloo_stg | gzip > /root/backups/cacaloo_$(date +\%Y\%m\%d_\%H\%M\%S).sql.gz
find /root/backups -name "cacaloo_*.sql.gz" -mtime +7 -delete
EOF

chmod +x /root/backup-mysql.sh
mkdir -p /root/backups

# Adicionar ao cron (todo dia às 3h)
crontab -e
# Adicione:
# 0 3 * * * /root/backup-mysql.sh
```
