# Guia Rápido: Setup do Usuário Deploy

## Passo 1: No seu computador local (Windows)

```powershell
# 1. Extrair chave pública da chave privada
cd C:\Users\leand\projects\cacaloo
ssh-keygen -y -f deploy-stg > deploy-stg.pub

# 2. Copiar chave pública para o servidor
scp deploy-stg.pub root@31.97.170.112:/tmp/

# 3. Copiar script de setup para o servidor
scp docs/setup-servidor/setup-usuario-deploy.sh root@31.97.170.112:/tmp/
```

## Passo 2: No servidor (via SSH como root)

```bash
# 1. Executar script de configuração
cd /tmp
chmod +x setup-usuario-deploy.sh
bash setup-usuario-deploy.sh /tmp/deploy-stg.pub

# 2. Verificar se o usuário foi criado
id deploy

# 3. Verificar permissões
ls -la /var/www/cacaloo
ls -la /home/deploy/.ssh/
```

## Passo 3: Testar conexão (no seu computador local)

```powershell
# Testar SSH com usuário deploy
ssh -i deploy-stg deploy@31.97.170.112

# Se conectou com sucesso, testar comando sudo
sudo systemctl status nginx
sudo systemctl status php8.2-fpm
```

## Passo 4: Configurar segredos no GitHub

1. Acesse: https://github.com/LeandroSoares/cacaloo/settings/secrets/actions
2. Clique em "New repository secret"
3. Adicione cada segredo:

### STG_SSH_PRIVATE_KEY
```powershell
Get-Content deploy-stg | Set-Clipboard
```
Cole no GitHub.

### STG_SSH_HOST
```
31.97.170.112
```

### STG_SSH_PORT
```
22
```

### STG_SSH_USER
```
deploy
```

### STG_DEPLOY_DIR
```
/var/www/cacaloo
```

## Passo 5: Testar pipeline

```powershell
# Fazer um push na branch v2
git add .
git commit -m "test: pipeline deploy"
git push origin v2
```

Acompanhe em: https://github.com/LeandroSoares/cacaloo/actions

## Troubleshooting

### Erro: Permission denied (publickey)
```bash
# No servidor, verificar se a chave está correta
cat /home/deploy/.ssh/authorized_keys

# Verificar permissões
ls -la /home/deploy/.ssh/
# Deve ser: drwx------ (700) para .ssh
# Deve ser: -rw------- (600) para authorized_keys
```

### Erro: deploy user can't write to /var/www/cacaloo
```bash
# No servidor como root
chown -R deploy:www-data /var/www/cacaloo
chmod -R 775 /var/www/cacaloo
```

### Erro: sudo requires password
```bash
# Verificar configuração sudoers
cat /etc/sudoers.d/deploy

# Testar como usuário deploy
sudo -l
```

## Comandos úteis

```bash
# Ver logs do último deploy
ssh -i deploy-stg deploy@31.97.170.112 'tail -50 /var/www/cacaloo/shared/storage/logs/laravel.log'

# Ver releases instaladas
ssh -i deploy-stg deploy@31.97.170.112 'ls -la /var/www/cacaloo/releases/'

# Ver qual release está ativa
ssh -i deploy-stg deploy@31.97.170.112 'readlink /var/www/cacaloo/current'

# Limpar releases antigas (manter últimas 3)
ssh -i deploy-stg deploy@31.97.170.112 'cd /var/www/cacaloo/releases && ls -t | tail -n +4 | xargs rm -rf'
```
