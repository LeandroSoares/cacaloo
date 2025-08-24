# Guia de Testes do Projeto CACALOO

## Introdução

Este documento fornece instruções sobre como executar os testes automatizados no projeto CACALOO e como criar novos testes seguindo a metodologia TDD (Test-Driven Development).

## Pré-requisitos

Antes de executar os testes, certifique-se de que:

1. O ambiente de desenvolvimento está configurado corretamente
2. Todas as dependências do projeto estão instaladas
3. Um banco de dados de teste está configurado no arquivo `.env.testing`

## Executando os Testes

### Executar todos os testes

```bash
php artisan test
```

### Executar um arquivo de teste específico

```bash
php artisan test --filter=RoleMiddlewareTest
```

### Executar um método de teste específico

```bash
php artisan test --filter=RoleMiddlewareTest::test_sysadmin_can_access_admin_area
```

### Executar testes com relatório detalhado

```bash
php artisan test --coverage
```

## Configuração do Banco de Dados para Testes

Recomendamos usar SQLite em memória para testes. Configure seu arquivo `.env.testing` com:

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

## Criando Novos Testes

### Gerar um novo teste

```bash
php artisan make:test NomeDoTesteTest --feature
```

### Estrutura Básica de um Teste

```php
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Configurações iniciais para o teste
    }

    public function test_example(): void
    {
        // Preparação (Arrange)
        $data = ['name' => 'Test'];

        // Ação (Act)
        $response = $this->post('/route', $data);

        // Verificação (Assert)
        $response->assertStatus(201);
        $this->assertDatabaseHas('table', $data);
    }
}
```

## Processo TDD

Ao implementar uma nova funcionalidade, siga estes passos:

1. **Escreva o teste primeiro**: Defina o comportamento esperado da funcionalidade através de um teste automatizado.

2. **Execute o teste e veja-o falhar** (Red): Confirme que o teste falha, pois a funcionalidade ainda não existe.

3. **Implemente o código mínimo necessário** (Green): Escreva apenas o código necessário para fazer o teste passar.

4. **Refatore o código** (Refactor): Melhore o código mantendo o teste passando.

5. **Repita o processo**: Para cada nova funcionalidade ou comportamento.

## Boas Práticas

1. **Nomeie os testes de forma descritiva**: O nome do método de teste deve descrever claramente o que está sendo testado.

2. **Um teste, um conceito**: Cada teste deve verificar um único conceito ou comportamento.

3. **Isolamento**: Os testes não devem depender uns dos outros.

4. **Consistência**: Use o mesmo padrão para todos os testes.

5. **Dados de teste**: Use factories para criar dados de teste.

## Exemplos de Testes no CACALOO

### Teste de Controller

```php
public function test_admin_can_create_new_user(): void
{
    // Preparação
    $this->actingAs($this->admin);
    $userData = [
        'name' => 'Novo Usuário',
        'email' => 'novo@exemplo.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'roles' => ['admin'],
    ];
    
    // Ação
    $response = $this->post('/admin/users', $userData);
    
    // Verificação
    $response->assertRedirect('/admin/users');
    $this->assertDatabaseHas('users', [
        'name' => 'Novo Usuário',
        'email' => 'novo@exemplo.com',
    ]);
}
```

### Teste de Middleware

```php
public function test_user_without_permission_cannot_access(): void
{
    // Preparação
    $user = User::factory()->create();
    $user->assignRole('user');
    
    // Ação
    $response = $this->actingAs($user)->get('/admin/dashboard');
    
    // Verificação
    $response->assertStatus(403);
}
```

## Cobertura de Testes

Procure manter uma cobertura de testes de pelo menos 80% do código. Para verificar a cobertura, execute:

```bash
php artisan test --coverage
```

## Recursos Adicionais

- [Documentação do PHPUnit](https://phpunit.de/documentation.html)
- [Documentação de Testes do Laravel](https://laravel.com/docs/testing)
- [Spatie Laravel Permission - Testes](https://spatie.be/docs/laravel-permission/v5/advanced-usage/testing)
