# Metodologia TDD (Test-Driven Development)

## Visão Geral

O projeto CACALOO adota a metodologia TDD (Test-Driven Development) como prática de desenvolvimento. O TDD é uma abordagem de desenvolvimento de software que se baseia na criação de testes automatizados antes da implementação do código de produção.

## Ciclo TDD

O TDD segue um ciclo de desenvolvimento conhecido como "Red-Green-Refactor":

1. **Red** - Escreva um teste que falha: Primeiro, escrevemos um teste que define o comportamento esperado da funcionalidade que queremos implementar. Neste momento, o teste falhará porque a funcionalidade ainda não existe.

2. **Green** - Faça o teste passar: Em seguida, implementamos o código de produção com o mínimo necessário para fazer o teste passar. O objetivo não é escrever código perfeito, mas sim fazer o teste passar.

3. **Refactor** - Melhore o código: Por último, refatoramos o código para melhorar sua qualidade, mantendo o teste passando. Isso pode incluir a eliminação de duplicações, melhorias na clareza do código e otimizações.

## Benefícios do TDD no Projeto CACALOO

- **Maior qualidade de código:** Os testes automatizados garantem que o código funcione conforme o esperado e ajudam a identificar problemas mais cedo.
  
- **Documentação viva:** Os testes servem como uma forma de documentação que demonstra como o código deve funcionar e é sempre mantida atualizada.
  
- **Design orientado por teste:** O TDD incentiva um design de código mais modular e com baixo acoplamento, facilitando manutenções futuras.
  
- **Confiança nas mudanças:** Com uma boa cobertura de testes, podemos fazer alterações no código com maior confiança de que não estamos introduzindo novos bugs.

## Tipos de Testes

No projeto CACALOO, trabalharemos com diferentes tipos de testes:

1. **Testes Unitários:** Testam componentes individuais isoladamente (ex: models, services).
   
2. **Testes de Integração:** Testam a interação entre diferentes componentes do sistema (ex: controllers com models).
   
3. **Testes de Feature:** Testam funcionalidades completas, simulando requisições HTTP e verificando as respostas.

## Ferramentas

- **PHPUnit:** Framework de testes para PHP.
  
- **Laravel Testing Suite:** Funcionalidades de teste específicas do Laravel.

## Convenções de Nomenclatura

- Os arquivos de teste unitário seguirão o padrão `NomeClasseTest.php`
  
- Os arquivos de teste de feature seguirão o padrão `NomeFuncionalidadeTest.php`
  
- Os métodos de teste seguirão o padrão `test_comportamento_esperado()`

## Metas de Cobertura

- **Mínimo de 80% de cobertura de código:** Estabelecemos como meta mínima 80% de cobertura de código pelos testes automatizados.
  
- **100% de cobertura para componentes críticos:** Para componentes críticos do sistema, como autenticação, controle de acesso e transações financeiras, buscamos atingir 100% de cobertura.

## Integração com CI/CD

Os testes automatizados serão executados automaticamente em cada commit para garantir que não haja regressões no código. O merge de pull requests só será permitido se todos os testes estiverem passando.

## Exemplo de Ciclo TDD no CACALOO

### 1. Escrever um teste para verificar se um usuário com papel "sysadmin" pode acessar uma rota administrativa:

```php
public function test_sysadmin_can_access_admin_route()
{
    $user = User::factory()->create();
    $user->assignRole('sysadmin');
    
    $response = $this->actingAs($user)->get('/admin/users');
    
    $response->assertStatus(200);
}
```

### 2. Implementar o código para fazer o teste passar:

```php
Route::middleware(['auth', 'role:sysadmin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
```

### 3. Refatorar o código se necessário, mantendo o teste passando.
