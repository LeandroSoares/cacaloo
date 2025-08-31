# Kanban - Sistema CACALOO

## A Fazer

### Feature 004: Sistema de Gestão de Eventos (Sprint 4)
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Estimativa**: 7 dias
- **Descrição**: Implementar sistema completo para gerenciamento de eventos do centro.
- **Tarefas**:
  - [ ] Criar migração para tabela de eventos
  - [ ] Criar modelo Event com relacionamentos
  - [ ] Implementar controller para administração de eventos
  - [ ] Desenvolver views para listagem, criação e edição de eventos
  - [ ] Implementar funcionalidade de cópia de eventos existentes
  - [ ] Desenvolver sistema de inscrição em eventos
  - [ ] Implementar notificações para participantes
  - [ ] Criar sistema de cancelamento de eventos
  - [ ] Desenvolver testes automatizados
  - [ ] Documentar API e interfaces

### Feature 005: Relatórios e Administração (Sprint 6)
- **Responsável**: Desenvolvedor
- **Prioridade**: Média
- **Estimativa**: 5 dias
- **Descrição**: Desenvolver sistema de relatórios administrativos e importação de dados.
- **Tarefas**:
  - [ ] Criar estrutura para geração de relatórios em Excel
  - [ ] Implementar relatórios administrativos filtrados
  - [ ] Desenvolver sistema de importação de dados em massa
  - [ ] Criar validações para importação de dados
  - [ ] Desenvolver testes automatizados
  - [ ] Documentar funcionalidades

## Em Andamento

### Feature 003: Sistema de Mensalidades e Gestão de Afastamentos (Sprint 3)
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Estimativa**: 6 dias
- **Descrição**: Implementar sistema de registro e controle de mensalidades e afastamentos.
- **Tarefas**:
  - [ ] Criar migração para tabela de mensalidades
  - [ ] Criar modelo Payment com relacionamentos
  - [ ] Implementar controller para administração de pagamentos
  - [ ] Desenvolver views para registro e visualização de pagamentos
  - [ ] Implementar sistema de visualização de pagamentos pendentes
  - [ ] Criar funcionalidade de histórico de pagamentos para usuários
  - [ ] Desenvolver relatório financeiro
  - [ ] Implementar sistema de gestão de médiuns afastados
  - [ ] Desenvolver testes automatizados
  - [ ] Documentar API e interfaces

## Concluído

### Feature 000: Sistema de Níveis de Acesso e Permissões (Sprint 1)
- **Responsável**: Desenvolvedor
- **Prioridade**: Crítica (pré-requisito)
- **Status**: ✅ Concluído
- **Descrição**: Implementar sistema de controle de acesso baseado em papéis usando Spatie Laravel Permission.
- **Tarefas Concluídas**:
  - [x] Instalar e configurar Spatie Laravel Permission
  - [x] Criar migração para papéis e permissões iniciais
  - [x] Implementar seeder para dados iniciais
  - [x] Criar trait para uso nos modelos relevantes
  - [x] Implementar middleware de proteção de rotas
  - [x] Criar diretivas Blade para controle na UI
  - [x] Desenvolver controller para gerenciamento de papéis
  - [x] Implementar views para administração de papéis
  - [x] Integrar com o cadastro/edição de usuários
  - [x] Criar testes automatizados para verificação de acesso
  - [x] Documentar uso do sistema para desenvolvedores

### Feature 001: Sistema de Convites para Novos Usuários (Sprint 1)
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Status**: ✅ Concluído
- **Dependências**: Feature 000 (Níveis de Acesso)
- **Descrição**: Implementar sistema que permite apenas usuários convidados se registrarem na plataforma.
- **Tarefas Concluídas**:
  - [x] Criar migração para tabela de convites
  - [x] Criar modelo Invite com relacionamentos
  - [x] Implementar gerador de códigos de convite únicos
  - [x] Criar controller para administração de convites
  - [x] Desenvolver views para listagem e criação de convites
  - [x] Modificar formulário de registro para incluir campo de convite
  - [x] Implementar validação de convites no registro
  - [x] Criar template de e-mail para convites
  - [x] Implementar lógica de envio/log de e-mails
  - [x] Desenvolver testes automatizados
  - [x] Documentar API e interfaces

### Feature 002: Gestão de Médiuns e Dados Mediúnicos (Sprint 2)
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Status**: ✅ Concluído
- **Descrição**: Implementar sistema completo de cadastro e perfil de médiuns com informações mediúnicas.
- **Tarefas Concluídas**:
  - [x] Criar migrações para todas as tabelas de dados mediúnicos
  - [x] Criar modelos com relacionamentos adequados
  - [x] Implementar controllers para gestão dos dados
  - [x] Desenvolver views para entrada e edição de dados
  - [x] Implementar políticas de controle de acesso
  - [x] Desenvolver área "Meus Dados" para autogerenciamento
  - [x] Criar funcionalidades de alteração de graduação mediúnica
  - [x] Implementar funcionalidade de alteração de função na casa
  - [x] Desenvolver testes automatizados
  - [x] Documentar API e interfaces

### Feature 003: Histórico Mediúnico (Sprint 3)
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Status**: ✅ Concluído
- **Descrição**: Implementar visualização consolidada do histórico mediúnico.
- **Tarefas Concluídas**:
  - [x] Criar página de histórico do médium
  - [x] Implementar visualização integrada de todas as informações
  - [x] Desenvolver interface para registro de mistérios
  - [x] Criar sistema de visualização do histórico como documento
  - [x] Implementar testes automatizados
  - [x] Documentar funcionalidades

---

## Próximas Features Planejadas

### Feature 006: Sistema de Comunicação e Notificações (Futuro)
- **Prioridade**: Média
- **Estimativa**: 4 dias
- **Descrição**: Desenvolver sistema de comunicação e notificações internas.

### Feature 007: Aplicativo Mobile (Futuro)
- **Prioridade**: Baixa
- **Estimativa**: 14 dias
- **Descrição**: Desenvolver aplicativo mobile para acesso às funcionalidades básicas do sistema.

---

*Documento atualizado em: 24 de agosto de 2025*
