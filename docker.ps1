# Script PowerShell para gerenciar o ambiente Docker do Cacaloo
param(
    [Parameter(Position=0)]
    [string]$Command = "help"
)

function Show-Help {
    Write-Host "Comandos disponíveis para o projeto Cacaloo:" -ForegroundColor Green
    Write-Host ""
    Write-Host "setup           " -ForegroundColor Yellow -NoNewline; Write-Host "Configuração inicial completa"
    Write-Host "build           " -ForegroundColor Yellow -NoNewline; Write-Host "Constrói as imagens Docker"
    Write-Host "up              " -ForegroundColor Yellow -NoNewline; Write-Host "Inicia todos os serviços"
    Write-Host "down            " -ForegroundColor Yellow -NoNewline; Write-Host "Para todos os serviços"
    Write-Host "restart         " -ForegroundColor Yellow -NoNewline; Write-Host "Reinicia todos os serviços"
    Write-Host "logs            " -ForegroundColor Yellow -NoNewline; Write-Host "Mostra logs dos serviços"
    Write-Host "logs-app        " -ForegroundColor Yellow -NoNewline; Write-Host "Mostra logs apenas da aplicação"
    Write-Host "shell           " -ForegroundColor Yellow -NoNewline; Write-Host "Acessa shell da aplicação"
    Write-Host "db-shell        " -ForegroundColor Yellow -NoNewline; Write-Host "Acessa shell do MariaDB"
    Write-Host "migrate         " -ForegroundColor Yellow -NoNewline; Write-Host "Executa migrações"
    Write-Host "migrate-fresh   " -ForegroundColor Yellow -NoNewline; Write-Host "Executa migrações do zero"
    Write-Host "seed            " -ForegroundColor Yellow -NoNewline; Write-Host "Executa seeders"
    Write-Host "fresh           " -ForegroundColor Yellow -NoNewline; Write-Host "Refaz banco com seeders"
    Write-Host "test            " -ForegroundColor Yellow -NoNewline; Write-Host "Executa testes"
    Write-Host "status          " -ForegroundColor Yellow -NoNewline; Write-Host "Mostra status dos serviços"
    Write-Host ""
    Write-Host "Exemplo de uso: .\docker.ps1 up" -ForegroundColor Cyan
}

function Invoke-Setup {
    Write-Host "Configurando ambiente inicial..." -ForegroundColor Green

    if (-not (Test-Path ".env.docker")) {
        Write-Host "Copiando .env.docker.example para .env.docker..." -ForegroundColor Yellow
        Copy-Item ".env.docker.example" ".env.docker"
        Write-Host "IMPORTANTE: Edite o arquivo .env.docker com suas configurações!" -ForegroundColor Red
    }

    docker-compose build
    docker-compose up -d

    Write-Host "Aguardando serviços ficarem prontos..." -ForegroundColor Green
    Start-Sleep -Seconds 10

    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate

    Write-Host "Setup concluído!" -ForegroundColor Green
}

switch ($Command.ToLower()) {
    "help" { Show-Help }
    "setup" { Invoke-Setup }
    "build" {
        Write-Host "Construindo imagens Docker..." -ForegroundColor Green
        docker-compose build --no-cache
    }
    "up" {
        Write-Host "Iniciando serviços..." -ForegroundColor Green
        docker-compose up -d
        Write-Host "Serviços iniciados!" -ForegroundColor Green
        Write-Host "Aplicação: http://localhost:8000" -ForegroundColor Yellow
        Write-Host "MailHog: http://localhost:8025" -ForegroundColor Yellow
    }
    "down" {
        Write-Host "Parando serviços..." -ForegroundColor Red
        docker-compose down
    }
    "restart" {
        docker-compose down
        docker-compose up -d
    }
    "logs" { docker-compose logs -f }
    "logs-app" { docker-compose logs -f app }
    "shell" { docker-compose exec app sh }
    "db-shell" { docker-compose exec mariadb mysql -u cacaloo_user -p cacaloo }
    "migrate" { docker-compose exec app php artisan migrate }
    "migrate-fresh" { docker-compose exec app php artisan migrate:fresh }
    "seed" { docker-compose exec app php artisan db:seed }
    "fresh" {
        docker-compose exec app php artisan migrate:fresh
        docker-compose exec app php artisan db:seed
    }
    "test" { docker-compose exec app php artisan test }
    "status" { docker-compose ps }
    default {
        Write-Host "Comando não reconhecido: $Command" -ForegroundColor Red
        Show-Help
    }
}
