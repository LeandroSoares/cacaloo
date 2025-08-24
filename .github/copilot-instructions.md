# GitHub Copilot - Instruções Laravel Expert

## 🎯 Padrões de Código
- Seguir **PSR-12** rigorosamente
- Usar **PHP 8.2+** com recursos modernos
- Código legível, limpo e de fácil manutenção
- Nomes descritivos para variáveis, funções e classes
- PHPDoc em classes e métodos complexos

## 🏗️ Arquitetura Laravel
- Laravel 11/12 com estrutura oficial
- Controllers magros usando dependency injection
- Business logic em Service classes ou Actions
- Form Requests para validação
- API Resources para respostas estruturadas
- Policies/Gates para autorização

## 📁 Estrutura de Diretórios
- `app/Http/Controllers` - Controllers
- `app/Models` - Modelos Eloquent
- `app/Http/Requests` - Validação de formulários
- `app/Http/Resources` - Recursos API
- `app/Services` - Lógica de negócio
- `app/Actions` - Ações de responsabilidade única
- `app/Enums` - Enumerações
- `app/Data` - DTOs (Data Transfer Objects)

## 🚀 PHP Moderno (8.2+)
- Propriedades **readonly** para imutabilidade
- **Enums** ao invés de constantes
- **Constructor Property Promotion**
- **Union Types** e **Intersection Types**
- **Nullsafe Operator** (?->)
- **Named Arguments** para clareza
- **Match expressions** ao invés de switch

## 🗄️ Banco de Dados
- Usar **Eloquent ORM** preferencialmente
- Migrations para todas as mudanças de schema
- Casts apropriados nos Models
- Eager loading para evitar N+1
- UUIDs como chaves primárias quando aplicável

## 🔒 Segurança
- Sempre validar entrada do usuário
- Usar prepared statements (automático no Eloquent)
- CSRF, XSS protection do Laravel
- Secrets no .env, nunca hard-coded
- Princípio do menor privilégio

## 🧪 Testes
- PHPUnit para testes
- Factories para dados de teste
- Feature tests para funcionalidades
- Unit tests para lógica de negócio
- Mocking com Http::fake()

## 📐 Princípios SOLID
- Single Responsibility Principle
- Open/Closed Principle  
- Liskov Substitution Principle
- Interface Segregation Principle
- Dependency Inversion Principle

## 🎨 Estilo de Resposta
- Ser direto e conciso
- Evitar cumprimentos como "Claro!" ou "Perfeito!"
- Focar na solução técnica
- Usar linguagem profissional

## Processo
- Depois de desenvolver uma feature deve rodar os testes para validar que não quebrou nada.
- Caso algum teste falhe, deve-se corrigir o problema antes de prosseguir.
- Sempre revisar o código antes de enviar um PR (Pull Request).
