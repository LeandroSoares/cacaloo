# Kanban - Sistema CACALOO

## A Fazer

### Feature 000: Sistema de Níveis de Acesso e Permissões
- **Responsável**: Desenvolvedor
- **Prioridade**: Crítica (pré-requisito)
- **Estimativa**: 3 dias
- **Descrição**: Implementar sistema de controle de acesso baseado em papéis usando Spatie Laravel Permission.
- **Tarefas**:
  - [ ] Instalar e configurar Spatie Laravel Permission
  - [ ] Criar migração para papéis e permissões iniciais
  - [ ] Implementar seeder para dados iniciais
  - [ ] Criar trait para uso nos modelos relevantes
  - [ ] Implementar middleware de proteção de rotas
  - [ ] Criar diretivas Blade para controle na UI
  - [ ] Desenvolver controller para gerenciamento de papéis
  - [ ] Implementar views para administração de papéis
  - [ ] Integrar com o cadastro/edição de usuários
  - [ ] Criar testes automatizados para verificação de acesso
  - [ ] Documentar uso do sistema para desenvolvedores

### Feature 001: Sistema de Convites para Novos Usuários
- **Responsável**: Desenvolvedor
- **Prioridade**: Alta
- **Estimativa**: 5 dias
- **Descrição**: Implementar sistema que permite apenas usuários convidados se registrarem na plataforma.
- **Dependências**: Feature 000 (Níveis de Acesso)
- **Tarefas**:
  - [ ] Criar migração para tabela de convites
  - [ ] Criar modelo Invite com relacionamentos
  - [ ] Implementar gerador de códigos de convite únicos
  - [ ] Criar controller para administração de convites
  - [ ] Desenvolver views para listagem e criação de convites
  - [ ] Modificar formulário de registro para incluir campo de convite
  - [ ] Implementar validação de convites no registro
  - [ ] Criar template de e-mail para convites
  - [ ] Implementar lógica de envio/log de e-mails
  - [ ] Desenvolver testes automatizados
  - [ ] Documentar API e interfaces

## Em Andamento

*Nenhuma tarefa em andamento no momento.*

## Revisão

*Nenhuma tarefa em revisão no momento.*

## Concluído

*Nenhuma tarefa concluída no momento.*

---

## Próximas Features Planejadas

### Feature 002: Página Inicial com Identidade Visual
- **Prioridade**: Média
- **Estimativa**: 3 dias
- **Descrição**: Desenvolver uma página inicial simples com a identidade visual do Centro.

### Feature 003: Cadastro de Médiuns
- **Prioridade**: Alta
- **Estimativa**: 5 dias
- **Descrição**: Implementar sistema completo de cadastro e perfil de médiuns.
