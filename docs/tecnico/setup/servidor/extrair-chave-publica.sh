#!/bin/bash

# Script para extrair chave pública de uma chave privada SSH
# Uso: bash extrair-chave-publica.sh [caminho_chave_privada]

set -e

PRIVATE_KEY="${1:-deploy-stg}"

if [ ! -f "${PRIVATE_KEY}" ]; then
    echo "Erro: Arquivo de chave privada '${PRIVATE_KEY}' não encontrado"
    echo "Uso: bash extrair-chave-publica.sh [caminho_chave_privada]"
    exit 1
fi

# Extrair chave pública
ssh-keygen -y -f "${PRIVATE_KEY}" > "${PRIVATE_KEY}.pub"

echo "Chave pública extraída com sucesso!"
echo "Arquivo criado: ${PRIVATE_KEY}.pub"
echo ""
echo "Conteúdo:"
cat "${PRIVATE_KEY}.pub"
echo ""
echo "Para adicionar ao servidor, execute:"
echo "ssh-copy-id -i ${PRIVATE_KEY}.pub deploy@31.97.170.112"
echo ""
echo "Ou copie manualmente:"
echo "scp ${PRIVATE_KEY}.pub root@31.97.170.112:/tmp/"
