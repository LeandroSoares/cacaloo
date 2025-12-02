# Registro de Correções e Soluções Técnicas

Este documento detalha os problemas encontrados durante a implantação e manutenção do sistema Cacaloo e suas respectivas soluções.

## 1. Content Security Policy (CSP) e Livewire

**Problema:**
O Livewire e o Alpine.js utilizam `eval()` internamente para processar expressões JavaScript. Em ambientes de produção (especialmente com Cloudflare ou configurações rígidas de servidor), o header `Content-Security-Policy` pode bloquear a execução de scripts inseguros, causando falhas silenciosas ou erros no console ("Content Security Policy of your site blocks the use of 'eval'").

**Solução:**
Implementamos um Middleware personalizado `App\Http\Middleware\AddCspHeader` que injeta explicitamente os headers permitindo `unsafe-eval` e `unsafe-inline`.

**Detalhe Técnico:**
Foi necessário usar a função nativa `header()` do PHP em vez da resposta do Laravel (`$response->headers->set`), pois em alguns ambientes compartilhados (CGI/FastCGI), os headers da aplicação podem ser sobrescritos ou ignorados se não forem enviados diretamente.

```php
// App/Http/Middleware/AddCspHeader.php
header("Content-Security-Policy: default-src * data: blob: 'unsafe-inline' 'unsafe-eval'; ...");
```

## 2. Injeção Duplicada de JavaScript (Alpine.js)

**Problema:**
A tela "Meus Dados" travava ou apresentava comportamento errático. O console mostrava erros indicando múltiplas inicializações do Alpine.js.

**Causa:**
O arquivo `resources/js/app.js` importava e inicializava o Alpine.js manualmente (`Alpine.start()`), mas o layout Blade já incluía a diretiva `@livewireScripts`, que também carrega e inicia o Alpine.js (versão 3+). Isso gerava conflito.

**Solução:**
Removemos a inicialização manual do Alpine.js no `app.js`, deixando o Livewire gerenciar isso automaticamente.

## 3. Comparação Estrita de Tipos (Strict Type Comparison)

**Problema:**
Ao tentar editar ou salvar registros (ex: Cruzamentos), a ação falhava silenciosamente ou com erro de autorização, mesmo o usuário sendo o dono do registro.

**Causa:**
O banco de dados (MySQL/MariaDB) pode retornar IDs numéricos como **strings** (ex: "1"). O código PHP fazia uma comparação estrita (`===`) com o ID do usuário logado (que é **inteiro**).
`"1" === 1` retorna `false`.

**Solução:**
Alteramos as comparações de ID para não estritas (`==`) nos métodos `edit`, `update`, `delete` e `save` dos componentes Livewire.

```php
// Antes (Falha)
if ($crossing->user_id === $this->user->id) { ... }

// Depois (Correção)
if ($crossing->user_id == $this->user->id) { ... }
```

## 4. Atualização de Componentes Livewire

**Problema:**
Campos de formulário não eram preenchidos ao clicar em "Editar".

**Causa:**
Uso de `$this->js('$wire.$refresh()')` para forçar a atualização. No Livewire 3, isso é desnecessário e pode causar condições de corrida (race conditions), onde o front-end tenta atualizar antes do back-end ter definido os dados.

**Solução:**
Remoção da chamada manual de refresh. O Livewire 3 detecta as mudanças nas propriedades públicas (`$this->entity = ...`) e atualiza a interface automaticamente.
