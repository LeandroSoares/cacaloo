#!/bin/bash

# Script para configurar banco cacaloo_stg em MariaDB já instalado
# Uso: bash config-banco-existente.sh

set -e

# Cores
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${BLUE}=== Configurando banco para aplicação (MariaDB existente) ===${NC}"

# Variáveis
DB_NAME="cacaloo_stg"
DB_USER="cacaloo_user"
DB_PASSWORD="$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)"

echo -e "${YELLOW}Digite a senha ROOT do MariaDB:${NC}"
read -s ROOT_PASSWORD

# Testar conexão root
echo -e "${BLUE}Testando conexão...${NC}"
if ! mysql -u root -p"${ROOT_PASSWORD}" -e "SELECT 1;" > /dev/null 2>&1; then
    echo -e "${RED}Erro: Senha root incorreta ou MariaDB não está acessível${NC}"
    exit 1
fi

echo -e "${GREEN}Conexão OK!${NC}"

# Criar banco e usuário
echo -e "${BLUE}Criando banco ${DB_NAME} e usuário ${DB_USER}...${NC}"
mysql -u root -p"${ROOT_PASSWORD}" <<-EOF
CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';
GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOF

echo -e "${GREEN}Banco e usuário criados!${NC}"

# Verificar
echo -e "${BLUE}Verificando...${NC}"
mysql -u root -p"${ROOT_PASSWORD}" -e "SHOW DATABASES;" | grep "${DB_NAME}"

# Salvar credenciais
cat > /root/.mariadb_credentials <<-CRED_EOF
# Credenciais MariaDB - Cacaloo Staging
# Gerado em: $(date)

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=${DB_NAME}
DB_USERNAME=${DB_USER}
DB_PASSWORD=${DB_PASSWORD}
CRED_EOF

chmod 600 /root/.mariadb_credentials

# Atualizar .env
ENV_FILE="/var/www/cacaloo/shared/.env"
if [ -f "${ENV_FILE}" ]; then
    echo -e "${BLUE}Atualizando ${ENV_FILE}...${NC}"
    cp "${ENV_FILE}" "${ENV_FILE}.backup.$(date +%Y%m%d%H%M%S)"

    sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=mysql/" "${ENV_FILE}"
    sed -i "s/DB_HOST=.*/DB_HOST=127.0.0.1/" "${ENV_FILE}"
    sed -i "s/DB_PORT=.*/DB_PORT=3306/" "${ENV_FILE}"
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" "${ENV_FILE}"
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" "${ENV_FILE}"
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" "${ENV_FILE}"

    echo -e "${GREEN}.env atualizado${NC}"
else
    echo -e "${YELLOW}.env não encontrado, você precisará configurar manualmente${NC}"
fi

# Resumo
echo ""
echo -e "${GREEN}=== Configuração concluída! ===${NC}"
echo ""
echo -e "${YELLOW}CREDENCIAIS (GUARDE EM LOCAL SEGURO):${NC}"
echo "----------------------------------------"
echo "Banco: ${DB_NAME}"
echo "Usuário: ${DB_USER}"
echo "Senha: ${DB_PASSWORD}"
echo ""
echo -e "${BLUE}Salvo em: /root/.mariadb_credentials${NC}"
echo ""
echo "Testar conexão:"
echo "mysql -u ${DB_USER} -p ${DB_NAME}"
