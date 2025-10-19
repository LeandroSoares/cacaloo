# Docker Environment - Cacaloo

Este projeto inclui uma configuração Docker completa para desenvolvimento local.

## 🚀 Início Rápido

### Pré-requisitos
- Docker Desktop instalado
- Docker Compose disponível

### Configuração Inicial

1. **Clone o repositório** (se ainda não fez)

2. **Configure as variáveis de ambiente:**
   ```bash
   cp .env.docker.example .env.docker
   ```
   Edite o arquivo `.env.docker` com suas configurações de banco de dados.

3. **Execute a configuração inicial:**
   ```bash
   # No Windows (PowerShell)
   .\docker.ps1 setup
   
   # No Linux/Mac
   make setup
   ```

## 🐳 Serviços Disponíveis

| Serviço | Porta | Descrição |
|---------|-------|-----------|
| **App Laravel** | 8000 | Aplicação principal |
| **MariaDB** | 3306 | Banco de dados |
| **MailHog** | 8025 | Interface de email para testes |
| **Redis** | 6379 | Cache e filas |

## 📋 Comandos Disponíveis

### Windows (PowerShell)
```powershell
# Mostrar ajuda
.\docker.ps1 help

# Iniciar ambiente
.\docker.ps1 up

# Parar ambiente  
.\docker.ps1 down

# Ver logs
.\docker.ps1 logs

# Acessar shell da aplicação
.\docker.ps1 shell

# Executar migrações
.\docker.ps1 migrate

# Executar testes
.\docker.ps1 test
```

### Linux/Mac (Makefile)
```bash
# Mostrar ajuda
make help

# Iniciar ambiente
make up

# Parar ambiente
make down

# Ver logs
make logs

# Acessar shell da aplicação
make shell

# Executar migrações
make migrate

# Executar testes
make test
```

## 🔧 Configurações Importantes

### Banco de Dados
- **Host:** `mariadb` (interno) / `localhost:3306` (externo)
- **Database:** `cacaloo`
- **User:** `cacaloo_user`
- **Password:** Definido no `.env.docker`

### Email (MailHog)
- **SMTP Host:** `mailhog`
- **SMTP Port:** `1025`
- **Web Interface:** http://localhost:8025

### Cache (Redis)
- **Host:** `redis`
- **Port:** `6379`

## 📁 Estrutura Docker

```
docker/
├── start.sh           # Script de inicialização
├── supervisord.conf   # Configuração do Supervisor
├── nginx.conf         # Configuração principal do Nginx
├── default.conf       # Virtual host do Nginx
└── mariadb/
    └── custom.cnf     # Configurações customizadas do MariaDB
```

## 🛠️ Desenvolvimento

### Executar Comandos Laravel
```bash
# Acessar shell do container
.\docker.ps1 shell  # Windows
make shell          # Linux/Mac

# Dentro do container
php artisan migrate
php artisan make:model Example
php artisan test
```

### Compilar Assets
```bash
# Desenvolvimento
docker-compose exec app npm run dev

# Produção
docker-compose exec app npm run build
```

### Logs e Debugging
```bash
# Ver logs da aplicação
.\docker.ps1 logs-app  # Windows
make logs-app          # Linux/Mac

# Ver todos os logs
.\docker.ps1 logs      # Windows
make logs              # Linux/Mac
```

## 🔒 Segurança

- As senhas padrão são apenas para desenvolvimento
- **NUNCA** use essas configurações em produção
- Altere todas as senhas no arquivo `.env.docker`
- O arquivo `.env.docker` está no `.gitignore`

## 🚨 Troubleshooting

### Porta já em uso
Se alguma porta estiver em uso, altere no `docker-compose.yml`:
```yaml
ports:
  - "8080:80"  # Mudança da porta 8000 para 8080
```

### Problemas de permissão
```bash
# Corrigir permissões (Linux/Mac)
sudo chown -R $USER:$USER storage bootstrap/cache

# Windows - executar PowerShell como administrador
```

### Limpar ambiente
```bash
# Parar e remover todos os containers
docker-compose down -v

# Remover imagens
docker-compose build --no-cache
```

## 📊 Monitoramento

### Status dos serviços
```bash
.\docker.ps1 status  # Windows
make status          # Linux/Mac
```

### Logs em tempo real
```bash
.\docker.ps1 logs    # Windows
make logs            # Linux/Mac
```

### Acesso direto ao banco
```bash
.\docker.ps1 db-shell  # Windows
make db-shell          # Linux/Mac
```
