# Pipeline para deploy no VPS de staging (`env:stg`)

## Gatilho
O workflow `Deploy to VPS staging` roda em pushes para a branch `v2`. Ele garante que o código enviado já foi testado localmente antes de disparar o script de deploy que está na própria base (`deploy.sh`).

## Passos executados
1. Checkout do repositório e configuração do PHP 8.2 com extensões necessárias.
2. Instalação das dependências PHP via Composer e preparo do `.env` (cópia de `.env.example` + `php artisan key:generate`).
3. Execução do teste `php artisan test --filter=CrossingFormTest` para validar o componente Livewire afetado.
4. Inicialização do agente SSH com a chave armazenada no segredo `STG_SSH_PRIVATE_KEY` e adição do host aos `known_hosts`.
5. Conexão SSH com o servidor de staging para rodar `ENVIRONMENT=stg ./deploy.sh` dentro do diretório informado por `STG_DEPLOY_DIR`, o mesmo script já utilizado manualmente para deploys.

## Segredos necessários
Configure os seguintes valores no repositório GitHub (Settings > Secrets):

| Nome | Descrição | Valor típico |
|------|-----------|--------------|
| `STG_SSH_PRIVATE_KEY` | Chave privada usada pelo agent no workflow. Deve ter acesso ao servidor de staging. | Conteúdo do `id_rsa` (sem senha) |
| `STG_SSH_HOST` | IP ou hostname do VPS de staging. | `staging.exemplo.com` |
| `STG_SSH_PORT` | Porta SSH (padrão 22). | `22` |
| `STG_SSH_USER` | Usuário que executa o deploy (ex: `deploy`). | `deploy` |
| `STG_DEPLOY_DIR` | Caminho absoluto onde o repositório permanece no VPS. | `/var/www/cacaloo` |

> O workflow já define `APP_ENV=stg` e passa `ENVIRONMENT=stg` para o `deploy.sh`, portanto nenhuma alteração na aplicação é necessária para respeitar o novo estágio.

## Como verificar o deploy
1. Push na `v2` ativa o workflow e você acompanha nos Actions logs.
2. Se o deploy SSH falhar, os logs indicarão erros de conexão ou script (permissões, git, dependências, etc.).
3. Caso precise forçar manualmente, conecte-se ao VPS e rode `cd /var/www/cacaloo && ENVIRONMENT=stg ./deploy.sh`.
4. Após o deploy, verifique o domínio/caminho configurado para a instância de staging.

## Observações adicionais
- Caso o repositório localize-se em subdiretórios diferentes no servidor, ajuste `STG_DEPLOY_DIR` em vez de alterar o workflow.
- Use `ssh-keyscan` no seu terminal para atualizar o `known_hosts` local antes de configurar o secret se o host for novo.
