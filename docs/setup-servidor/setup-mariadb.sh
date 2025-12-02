#!/bin/bash

# Script para instalar e configurar MariaDB no servidor staging
# Uso: bash setup-mariadb.sh

set -e

# Cores para output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${BLUE}=== Instalando e configurando MariaDB ===${NC}"

# Variáveis - ALTERE CONFORME NECESSÁRIO
DB_NAME="cacaloo_stg"
DB_USER="cacaloo_user"
DB_PASSWORD="$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)"
DB_ROOT_PASSWORD="$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)"

# 1. Atualizar sistema
echo -e "${BLUE}1. Atualizando repositórios...${NC}"
apt update

# 2. Instalar MariaDB
echo -e "${BLUE}2. Instalando MariaDB Server...${NC}"
DEBIAN_FRONTEND=noninteractive apt install -y mariadb-server mariadb-client

# 3. Iniciar e habilitar serviço
echo -e "${BLUE}3. Iniciando serviço MariaDB...${NC}"
systemctl start mariadb
systemctl enable mariadb

# 4. Verificar status
echo -e "${BLUE}4. Verificando status...${NC}"
systemctl status mariadb --no-pager || true

# 5. Configurar senha root do MariaDB
echo -e "${BLUE}5. Configurando senha root do MariaDB...${NC}"
mysql -u root <<-EOF
ALTER USER 'root'@'localhost' IDENTIFIED BY '${DB_ROOT_PASSWORD}';
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
FLUSH PRIVILEGES;
EOF

# 6. Criar banco de dados e usuário
echo -e "${BLUE}6. Criando banco de dados e usuário...${NC}"
mysql -u root -p"${DB_ROOT_PASSWORD}" <<-EOF
CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';
GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOF

# 7. Verificar criação
echo -e "${BLUE}7. Verificando banco criado...${NC}"
mysql -u root -p"${DB_ROOT_PASSWORD}" -e "SHOW DATABASES;" | grep -i cacaloo || echo -e "${RED}Erro ao criar banco${NC}"

# 8. Otimizar configurações do MariaDB
echo -e "${BLUE}8. Otimizando configurações...${NC}"
cat > /etc/mysql/mariadb.conf.d/99-cacaloo.cnf <<-'MARIADB_EOF'
[mysqld]
# Otimizações para Laravel
max_connections = 150
connect_timeout = 10
wait_timeout = 600
max_allowed_packet = 64M
thread_cache_size = 128
sort_buffer_size = 4M
bulk_insert_buffer_size = 16M
tmp_table_size = 64M
max_heap_table_size = 64M

# InnoDB Settings
innodb_buffer_pool_size = 256M
innodb_log_file_size = 64M
innodb_file_per_table = 1
innodb_flush_log_at_trx_commit = 2
innodb_flush_method = O_DIRECT

# Query Cache (deprecated mas ainda útil em algumas versões)
query_cache_type = 1
query_cache_limit = 2M
query_cache_size = 64M

# Logs
slow_query_log = 1
slow_query_log_file = /var/log/mysql/slow-query.log
long_query_time = 2

# Character Set
character_set_server = utf8mb4
collation_server = utf8mb4_unicode_ci

[client]
default-character-set = utf8mb4
MARIADB_EOF

# 9. Reiniciar MariaDB
echo -e "${BLUE}9. Reiniciando MariaDB...${NC}"
systemctl restart mariadb

# 10. Salvar credenciais em arquivo seguro
echo -e "${BLUE}10. Salvando credenciais...${NC}"
cat > /root/.mariadb_credentials <<-CRED_EOF
# Credenciais MariaDB - Servidor Staging
# Gerado em: $(date)

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=${DB_NAME}
DB_USERNAME=${DB_USER}
DB_PASSWORD=${DB_PASSWORD}

# Root password (guardar com segurança)
DB_ROOT_PASSWORD=${DB_ROOT_PASSWORD}
CRED_EOF

chmod 600 /root/.mariadb_credentials

# 11. Atualizar .env do projeto
ENV_FILE="/var/www/cacaloo/shared/.env"
if [ -f "${ENV_FILE}" ]; then
    echo -e "${BLUE}11. Atualizando ${ENV_FILE}...${NC}"

    # Backup do .env atual
    cp "${ENV_FILE}" "${ENV_FILE}.backup.$(date +%Y%m%d%H%M%S)"

    # Atualizar configurações de banco
    sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/" "${ENV_FILE}"
    sed -i "s/DB_HOST=.*/DB_HOST=127.0.0.1/" "${ENV_FILE}"
    sed -i "s/DB_PORT=.*/DB_PORT=3306/" "${ENV_FILE}"
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" "${ENV_FILE}"
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" "${ENV_FILE}"
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" "${ENV_FILE}"

    echo -e "${GREEN}.env atualizado${NC}"
else
    echo -e "${YELLOW}.env não encontrado em ${ENV_FILE}${NC}"
    echo -e "${YELLOW}Configure manualmente depois${NC}"
fi

# 12. Resumo
echo ""
echo -e "${GREEN}=== MariaDB instalado e configurado com sucesso! ===${NC}"
echo ""
echo -e "${YELLOW}CREDENCIAIS (GUARDE EM LOCAL SEGURO):${NC}"
echo "----------------------------------------"
echo "Banco de dados: ${DB_NAME}"
echo "Usuário: ${DB_USER}"
echo "Senha: ${DB_PASSWORD}"
echo ""
echo "Root password: ${DB_ROOT_PASSWORD}"
echo ""
echo -e "${BLUE}Credenciais também salvas em: /root/.mariadb_credentials${NC}"
echo ""
echo -e "${YELLOW}Próximos passos:${NC}"
echo "1. Copie as credenciais acima e guarde em um gerenciador de senhas"
echo "2. Configure o .env em /var/www/cacaloo/shared/.env (se ainda não foi feito automaticamente)"
echo "3. Rode as migrações: cd /var/www/cacaloo/current && php artisan migrate"
echo ""
echo -e "${BLUE}Comandos úteis:${NC}"
echo "# Conectar ao MariaDB como root:"
echo "mysql -u root -p"
echo ""
echo "# Conectar como usuário da aplicação:"
echo "mysql -u ${DB_USER} -p ${DB_NAME}"
echo ""
echo "# Ver logs lentos:"
echo "tail -f /var/log/mysql/slow-query.log"
echo ""
echo "# Backup do banco:"
echo "mysqldump -u root -p ${DB_NAME} > backup_\$(date +%Y%m%d).sql"
