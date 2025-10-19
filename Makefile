# Makefile para gerenciar o ambiente Docker do Cacaloo

.PHONY: help build up down restart logs shell db-shell migrate fresh seed test

# Detecta se está rodando no Windows PowerShell
ifeq ($(OS),Windows_NT)
    SHELL := powershell.exe
    .SHELLFLAGS := -NoProfile -Command
    ECHO_GREEN = Write-Host -ForegroundColor Green
    ECHO_YELLOW = Write-Host -ForegroundColor Yellow
    ECHO_RED = Write-Host -ForegroundColor Red
    ECHO_CYAN = Write-Host -ForegroundColor Cyan
    ECHO_WHITE = Write-Host -ForegroundColor White
else
    # Unix/Linux/macOS com cores ANSI
    GREEN := \033[32m
    YELLOW := \033[33m
    RED := \033[31m
    CYAN := \033[36m
    NC := \033[0m
    ECHO_GREEN = echo "$(GREEN)"
    ECHO_YELLOW = echo "$(YELLOW)"
    ECHO_RED = echo "$(RED)"
endif

help: ## Mostra esta ajuda
ifeq ($(OS),Windows_NT)
	@$(ECHO_GREEN) "======================================"
	@$(ECHO_GREEN) "  COMANDOS CACALOO - PROJETO LARAVEL  "
	@$(ECHO_GREEN) "======================================"
	@echo ""
	@$(ECHO_CYAN) "COMANDOS PRINCIPAIS:"
	@echo "  setup                 - Configuração inicial completa"
	@echo "  up                    - Inicia todos os serviços"
	@echo "  down                  - Para todos os serviços"
	@echo "  shell                 - Acessa shell da aplicação"
	@echo ""
	@$(ECHO_CYAN) "DESENVOLVIMENTO:"
	@echo "  migrate               - Executa migrações"
	@echo "  fresh                 - Refaz banco com seeders"
	@echo "  test                  - Executa testes"
	@echo "  pint                  - Formatador de código"
	@echo ""
	@$(ECHO_CYAN) "UTILITÁRIOS:"
	@echo "  logs                  - Mostra logs dos serviços"
	@echo "  status                - Mostra status dos serviços"
	@echo "  cache-clear           - Limpa todos os caches"
	@echo ""
	@$(ECHO_YELLOW) "💡 Tip: Use 'make <comando>' para executar"
else
	@echo "$(GREEN)Comandos disponíveis para o projeto Cacaloo:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'
endif

build: ## Constrói as imagens Docker
ifeq ($(OS),Windows_NT)
	@$(ECHO_GREEN) "🔨 Construindo imagens Docker..."
else
	@echo "$(GREEN)Construindo imagens Docker...$(NC)"
endif
	docker-compose build --no-cache

up: ## Inicia todos os serviços
ifeq ($(OS),Windows_NT)
	@$(ECHO_GREEN) "🚀 Iniciando serviços..."
	@docker-compose up -d
	@$(ECHO_GREEN) "✅ Serviços iniciados!"
	@$(ECHO_YELLOW) "🌐 Aplicação: http://localhost:8000"
	@$(ECHO_YELLOW) "📧 MailHog: http://localhost:8025"
else
	@echo "$(GREEN)Iniciando serviços...$(NC)"
	docker-compose up -d
	@echo "$(GREEN)Serviços iniciados!$(NC)"
	@echo "$(YELLOW)Aplicação: http://localhost:8000$(NC)"
	@echo "$(YELLOW)MailHog: http://localhost:8025$(NC)"
endif

down: ## Para todos os serviços
ifeq ($(OS),Windows_NT)
	@$(ECHO_RED) "🛑 Parando serviços..."
else
	@echo "$(RED)Parando serviços...$(NC)"
endif
	docker-compose down

restart: down up ## Reinicia todos os serviços

logs: ## Mostra logs dos serviços
	docker-compose logs -f

logs-app: ## Mostra logs apenas da aplicação
	docker-compose logs -f app

shell: ## Acessa shell da aplicação
	docker-compose exec app sh

db-shell: ## Acessa shell do MariaDB
	docker-compose exec mariadb mysql -u cacaloo_user -p cacaloo

migrate: ## Executa migrações
	docker-compose exec app php artisan migrate

migrate-fresh: ## Executa migrações do zero
	docker-compose exec app php artisan migrate:fresh

seed: ## Executa seeders
	docker-compose exec app php artisan db:seed

fresh: migrate-fresh seed ## Refaz banco com seeders

test: ## Executa testes
	docker-compose exec app php artisan test

test-coverage: ## Executa testes com coverage
	docker-compose exec app php artisan test --coverage

pint: ## Executa Laravel Pint (formatador de código)
	docker-compose exec app ./vendor/bin/pint

composer-install: ## Instala dependências Composer
	docker-compose exec app composer install

npm-install: ## Instala dependências NPM
	docker-compose exec app npm install

npm-dev: ## Compila assets para desenvolvimento
	docker-compose exec app npm run dev

npm-build: ## Compila assets para produção
	docker-compose exec app npm run build

cache-clear: ## Limpa todos os caches
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

setup: ## Configuração inicial completa
	@echo "$(GREEN)Configurando ambiente inicial...$(NC)"
	@if [ ! -f .env.docker ]; then \
		echo "$(YELLOW)Copiando .env.docker.example para .env.docker...$(NC)"; \
		cp .env.docker.example .env.docker; \
		echo "$(RED)IMPORTANTE: Edite o arquivo .env.docker com suas configurações!$(NC)"; \
	fi
	docker-compose build
	docker-compose up -d
	@echo "$(GREEN)Aguardando serviços ficarem prontos...$(NC)"
	sleep 10
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate
	@echo "$(GREEN)Setup concluído!$(NC)"

status: ## Mostra status dos serviços
	docker-compose ps
