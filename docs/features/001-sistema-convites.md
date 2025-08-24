# Feature: Sistema de Convites para Novos Usuários

## Identificação
- **ID**: FEATURE-001
- **Prioridade**: Alta
- **Sprint**: 1
- **Estimativa**: 5 dias

## Descrição
Desenvolver um sistema que permita que apenas usuários convidados possam se registrar na plataforma CACALOO. Um administrador deverá poder gerar convites com data de expiração e acompanhar quais convites foram utilizados.

## Objetivos
- Controlar o acesso ao sistema, permitindo apenas usuários autorizados
- Proporcionar um mecanismo seguro para inclusão de novos membros
- Manter histórico de convites enviados e utilizados
- Evitar registros não autorizados na plataforma

## Requisitos Funcionais

### 1. Geração de Convites
- Administradores podem gerar convites com e-mail de destino
- Cada convite deve ter um código único
- Convites devem ter data de expiração configurável
- Sistema deve registrar quem gerou o convite e quando

### 2. Envio de Convites
- O sistema deve registrar o convite no banco de dados
- E-mails de convite devem ser enviados automaticamente (em produção)
- Em ambiente de desenvolvimento, os e-mails devem ser registrados em log
- Deve ser possível reenviar um convite quando necessário

### 3. Aceitação de Convites
- Usuário deve informar o código do convite durante o registro
- Sistema deve validar se o convite é válido e não expirado
- Após utilização, o convite deve ser marcado como utilizado
- Convites só podem ser usados uma única vez

### 4. Gerenciamento de Convites
- Interface para listar todos os convites
- Filtros por status (pendente, aceito, expirado)
- Opção para cancelar convites ainda não utilizados
- Estatísticas básicas de uso (taxa de aceitação, tempo médio)

## Modelo de Dados

### Tabela: invites
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | Identificador único (PK) |
| code | string | Código único do convite |
| email | string | E-mail do convidado |
| status | enum | Pendente, Utilizado, Expirado, Cancelado |
| expires_at | datetime | Data de expiração |
| created_by | bigint | ID do usuário que criou o convite (FK users) |
| created_at | datetime | Data de criação |
| updated_at | datetime | Data da última atualização |
| used_at | datetime | Data em que o convite foi utilizado (nullable) |
| used_by | bigint | ID do usuário que usou o convite (FK users) (nullable) |

## Interface de Usuário

### 1. Página de Administração de Convites
- Lista de convites existentes com status
- Formulário para criar novo convite
- Botões para ações (reenviar, cancelar)
- Filtros e busca

### 2. Formulário de Registro com Campo de Convite
- Campo para e-mail (deve corresponder ao e-mail do convite)
- Campo para código de convite
- Validação em tempo real da validade do convite
- Mensagens de erro específicas

### 3. E-mail de Convite
- Logo do CACALOO
- Texto explicativo sobre o sistema
- Código do convite em destaque
- Link direto para a página de registro com o código pré-preenchido
- Informação sobre a data de expiração

## Fluxo de Trabalho

1. **Administrador gera convite**:
   - Preenche e-mail do convidado
   - Define prazo de expiração
   - Sistema gera código único
   - Sistema salva o convite no banco de dados

2. **Sistema envia convite**:
   - Em produção: e-mail enviado via SMTP
   - Em desenvolvimento: e-mail registrado em log
   - Convite marcado como pendente

3. **Usuário recebe convite**:
   - Clica no link do e-mail
   - É direcionado para página de registro

4. **Usuário se registra**:
   - Preenche dados pessoais
   - Fornece o código de convite (ou já vem preenchido do link)
   - Sistema valida o convite
   - Após registro completo, convite é marcado como utilizado

## Testes

### Testes Unitários
- Validação de geração de códigos únicos
- Expiração de convites
- Validação de e-mails

### Testes de Integração
- Fluxo completo de criação, envio e utilização
- Interação com o sistema de usuários
- Verificação de envio de e-mails (em log)

### Testes de Aceitação
- Administrador consegue gerar convites
- Usuário consegue se registrar com convite válido
- Usuário não consegue se registrar sem convite válido
- Convites expirados são tratados corretamente

## Considerações Técnicas

- Utilizar pacote de autenticação do Laravel
- Gerar códigos de convite seguros (com ajuda da IA)
- Implementar proteção contra tentativas de força bruta
- Configurar filas para envio de e-mails em produção
- Em desenvolvimento, usar driver de e-mail "log"

## Critérios de Aceitação
- Administradores podem gerar e gerenciar convites
- E-mails de convite são enviados/registrados corretamente
- Apenas usuários com convites válidos podem se registrar
- Sistema mantém histórico completo de convites
- Interface é intuitiva e responsiva

## Dependências
- Configuração de banco de dados
- Sistema básico de autenticação
- Configuração de e-mail (log em desenvolvimento)
- **Feature 000: Sistema de Níveis de Acesso e Permissões** (crítica)

---

## Tarefas de Implementação

1. [ ] Criar migração para tabela de convites
2. [ ] Criar modelo Invite com relacionamentos
3. [ ] Implementar gerador de códigos de convite únicos
4. [ ] Criar controller para administração de convites
5. [ ] Desenvolver views para listagem e criação de convites
6. [ ] Modificar formulário de registro para incluir campo de convite
7. [ ] Implementar validação de convites no registro
8. [ ] Criar template de e-mail para convites
9. [ ] Implementar lógica de envio/log de e-mails
10. [ ] Desenvolver testes automatizados
11. [ ] Documentar API e interfaces
