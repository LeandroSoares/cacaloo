#!/bin/bash

# Script para criar usuário de deploy com permissões necessárias
# Uso: bash setup-usuario-deploy.sh [chave_publica_path]

set -e

# Cores para output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${BLUE}=== Configurando usuário de deploy ===${NC}"

# Variáveis
DEPLOY_USER="deploy"
DEPLOY_HOME="/home/${DEPLOY_USER}"
APP_DIR="/var/www/cacaloo"
PUBLIC_KEY_PATH="${1:-}"

# 1. Criar usuário deploy se não existir
if id "${DEPLOY_USER}" &>/dev/null; then
    echo -e "${YELLOW}Usuário ${DEPLOY_USER} já existe${NC}"
else
    echo -e "${BLUE}1. Criando usuário ${DEPLOY_USER}...${NC}"
    useradd -m -s /bin/bash "${DEPLOY_USER}"
    echo -e "${GREEN}Usuário criado${NC}"
fi

# 2. Adicionar usuário aos grupos necessários
echo -e "${BLUE}2. Adicionando ${DEPLOY_USER} aos grupos www-data...${NC}"
usermod -aG www-data "${DEPLOY_USER}"

# 3. Configurar diretório SSH
echo -e "${BLUE}3. Configurando SSH para ${DEPLOY_USER}...${NC}"
mkdir -p "${DEPLOY_HOME}/.ssh"
touch "${DEPLOY_HOME}/.ssh/authorized_keys"
chmod 700 "${DEPLOY_HOME}/.ssh"
chmod 600 "${DEPLOY_HOME}/.ssh/authorized_keys"
chown -R "${DEPLOY_USER}:${DEPLOY_USER}" "${DEPLOY_HOME}/.ssh"

# 4. Adicionar chave pública se fornecida
if [ -n "${PUBLIC_KEY_PATH}" ] && [ -f "${PUBLIC_KEY_PATH}" ]; then
    echo -e "${BLUE}4. Adicionando chave pública ao authorized_keys...${NC}"
    cat "${PUBLIC_KEY_PATH}" >> "${DEPLOY_HOME}/.ssh/authorized_keys"
    echo -e "${GREEN}Chave adicionada${NC}"
else
    echo -e "${YELLOW}4. Nenhuma chave pública fornecida. Cole manualmente em:${NC}"
    echo -e "${YELLOW}   ${DEPLOY_HOME}/.ssh/authorized_keys${NC}"
fi

# 5. Criar estrutura de diretórios se não existir
echo -e "${BLUE}5. Garantindo estrutura de diretórios em ${APP_DIR}...${NC}"
mkdir -p "${APP_DIR}"/{releases,shared}
mkdir -p "${APP_DIR}"/shared/storage/{app,framework/{cache,sessions,views},logs}
touch "${APP_DIR}/shared/.env"

# 6. Ajustar ownership e permissões
echo -e "${BLUE}6. Ajustando permissões...${NC}"
chown -R "${DEPLOY_USER}:www-data" "${APP_DIR}"
chmod -R 775 "${APP_DIR}/shared/storage"
chmod 664 "${APP_DIR}/shared/.env"
chmod 775 "${APP_DIR}/releases"
chmod 775 "${APP_DIR}/shared"

# 7. Configurar sudoers para comandos específicos necessários no deploy
echo -e "${BLUE}7. Configurando sudoers para ${DEPLOY_USER}...${NC}"
SUDOERS_FILE="/etc/sudoers.d/${DEPLOY_USER}"

cat > "${SUDOERS_FILE}" << 'EOF'
# Permitir deploy user executar comandos necessários sem senha
deploy ALL=(ALL) NOPASSWD: /usr/bin/systemctl restart nginx
deploy ALL=(ALL) NOPASSWD: /usr/bin/systemctl reload nginx
deploy ALL=(ALL) NOPASSWD: /usr/bin/systemctl restart php*-fpm
deploy ALL=(ALL) NOPASSWD: /usr/bin/systemctl reload php*-fpm
deploy ALL=(ALL) NOPASSWD: /usr/bin/chown -R www-data\:www-data /var/www/cacaloo/*
deploy ALL=(ALL) NOPASSWD: /usr/bin/chmod -R * /var/www/cacaloo/*
deploy ALL=(ALL) NOPASSWD: /bin/ln -sfn /var/www/cacaloo/releases/* /var/www/cacaloo/current
EOF

chmod 440 "${SUDOERS_FILE}"
visudo -c -f "${SUDOERS_FILE}"

echo -e "${GREEN}Sudoers configurado${NC}"

# 8. Criar script de deploy wrapper
echo -e "${BLUE}8. Criando script wrapper para deploy...${NC}"
cat > "${DEPLOY_HOME}/deploy-wrapper.sh" << 'WRAPPER_EOF'
#!/bin/bash
# Wrapper script executado pelo GitHub Actions via SSH

set -e

DEPLOY_DIR="/var/www/cacaloo"
ENVIRONMENT="${ENVIRONMENT:-stg}"

cd "${DEPLOY_DIR}"

# Executar o script de deploy existente
if [ -f "./deploy.sh" ]; then
    ENVIRONMENT="${ENVIRONMENT}" ./deploy.sh
else
    echo "Script deploy.sh não encontrado em ${DEPLOY_DIR}"
    exit 1
fi
WRAPPER_EOF

chmod +x "${DEPLOY_HOME}/deploy-wrapper.sh"
chown "${DEPLOY_USER}:${DEPLOY_USER}" "${DEPLOY_HOME}/deploy-wrapper.sh"

# 9. Garantir que deploy pode escrever no diretório de releases
echo -e "${BLUE}9. Configurando ACLs para garantir permissões corretas...${NC}"
if command -v setfacl &> /dev/null; then
    setfacl -R -m u:${DEPLOY_USER}:rwx "${APP_DIR}"
    setfacl -R -m d:u:${DEPLOY_USER}:rwx "${APP_DIR}"
    setfacl -R -m g:www-data:rx "${APP_DIR}"
    setfacl -R -m d:g:www-data:rx "${APP_DIR}"
    echo -e "${GREEN}ACLs configuradas${NC}"
else
    echo -e "${YELLOW}setfacl não disponível, pulando configuração de ACLs${NC}"
fi

# 10. Resumo
echo ""
echo -e "${GREEN}=== Configuração concluída ===${NC}"
echo ""
echo "Usuário: ${DEPLOY_USER}"
echo "Home: ${DEPLOY_HOME}"
echo "Diretório da aplicação: ${APP_DIR}"
echo "SSH autorizado: ${DEPLOY_HOME}/.ssh/authorized_keys"
echo ""
echo -e "${BLUE}Comandos permitidos via sudo (sem senha):${NC}"
echo "  - systemctl restart/reload nginx"
echo "  - systemctl restart/reload php*-fpm"
echo "  - chown/chmod em ${APP_DIR}"
echo "  - criar symlink para /var/www/cacaloo/current"
echo ""
echo -e "${YELLOW}Próximos passos:${NC}"

if [ -z "${PUBLIC_KEY_PATH}" ] || [ ! -f "${PUBLIC_KEY_PATH}" ]; then
    echo "1. Adicione a chave pública do GitHub Actions em:"
    echo "   ${DEPLOY_HOME}/.ssh/authorized_keys"
    echo ""
    echo "   Exemplo:"
    echo "   echo 'ssh-ed25519 AAAA...' >> ${DEPLOY_HOME}/.ssh/authorized_keys"
fi

echo "2. Configure os segredos no GitHub Actions:"
echo "   STG_SSH_USER=deploy"
echo "   STG_SSH_HOST=31.97.170.112"
echo "   STG_SSH_PORT=22"
echo "   STG_DEPLOY_DIR=/var/www/cacaloo"
echo ""
echo "3. Teste a conexão SSH:"
echo "   ssh -i deploy-stg deploy@31.97.170.112"
echo ""
echo "4. Configure o arquivo .env em:"
echo "   ${APP_DIR}/shared/.env"
