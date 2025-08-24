# Sprint 1: Fundação e Autenticação

## Objetivo
Estabelecer a infraestrutura base do sistema CACALOO e implementar o sistema de autenticação com convites, criando uma base sólida para as próximas sprints.

## Duração
3 semanas (ajustado para desenvolvedor solo com suporte de IA)

## Tarefas

### 1. Configuração do Ambiente de Desenvolvimento
- **Descrição**: Configurar o ambiente de desenvolvimento com Laravel, PHP, MySQL e ferramentas necessárias.
- **Atividades**:
  - Instalar PHP 8.2+ e extensões necessárias
  - Configurar Composer e instalar Laravel
  - Configurar banco de dados MySQL
  - Configurar ambiente de testes
  - Definir padrões de código com suporte da IA
- **Critérios de Aceitação**:
  - Ambiente local funcionando corretamente
  - Estrutura do projeto Laravel criada e funcional
  - Banco de dados configurado e acessível
  - Repositório Git inicializado com estrutura simples de branches (main/dev)

### 2. Registro do Domínio cacaloo.com.br
- **Descrição**: Adquirir e configurar o domínio cacaloo.com.br para uso no sistema.
- **Atividades**:
  - Verificar disponibilidade do domínio
  - Adquirir o domínio através de um registrador confiável
  - Configurar DNS e apontamentos necessários
  - Configurar certificado SSL
- **Critérios de Aceitação**:
  - Domínio registrado e sob controle da organização
  - DNS configurado corretamente
  - Certificado SSL instalado e funcionando
  - Domínio acessível via HTTPS

### 3. Sistema de Convites para Novos Usuários
- **Descrição**: Desenvolver um sistema onde apenas usuários convidados podem se registrar no sistema.
- **Atividades**:
  - Criar tabela de convites no banco de dados
  - Utilizar suporte da IA para gerar código de convites únicos
  - Desenvolver interface simples para administradores gerarem convites
  - Implementar validação de convites no registro
  - Adicionar expiração de convites não utilizados
- **Critérios de Aceitação**:
  - Administradores podem gerar convites para novos usuários
  - Apenas e-mails convidados podem se registrar
  - Convites possuem expiração configurável
  - Sistema registra histórico básico de convites

### 4. Integração com Servidor de E-mail
- **Descrição**: Configurar o sistema para enviar e-mails de convite, confirmação e notificações.
- **Atividades**:
  - Configurar servidor SMTP para envio de e-mails (com suporte da IA)
  - Implementar templates básicos de e-mail responsivos
  - Criar fluxo simples de envio de convites por e-mail
  - Implementar verificação básica de e-mail
  - Utilizar filas de e-mail do Laravel para melhor performance
- **Critérios de Aceitação**:
  - E-mails de convite são enviados corretamente
  - Templates de e-mail seguem identidade visual básica do centro
  - Verificação de e-mail funciona conforme esperado
  - Emails são processados em fila para evitar bloqueios

### 5. Configuração de Níveis de Acesso e Permissões
- **Descrição**: Implementar um sistema simplificado de controle de acesso baseado em papéis.
- **Atividades**:
  - Definir papéis básicos do sistema (Administrador, Médium, Consulente)
  - Implementar sistema de permissões utilizando pacotes Laravel
  - Criar middleware básico de verificação de permissões (com ajuda da IA)
  - Desenvolver interface simples de gerenciamento de papéis
- **Critérios de Aceitação**:
  - Sistema possui níveis de acesso funcionais
  - Permissões básicas atribuídas aos papéis principais
  - Interface permite atribuir papéis aos usuários
  - Rotas protegidas conforme nível de acesso

### 6. Página Inicial com Identidade Visual
- **Descrição**: Desenvolver uma página inicial simples com a identidade visual do Centro.
- **Atividades**:
  - Obter elementos visuais básicos (logo, cores) do Centro
  - Desenvolver layout responsivo utilizando Tailwind CSS (com suporte da IA)
  - Implementar componentes essenciais de navegação
  - Criar área básica de login e registro
- **Critérios de Aceitação**:
  - Página inicial apresenta a identidade visual do Centro
  - Layout funciona em dispositivos móveis e desktop
  - Navegação básica implementada
  - Área de login/registro funcional

## Riscos
- Sobrecarga de trabalho para um único desenvolvedor
- Limitações técnicas em algumas integrações
- Definição incompleta dos níveis de acesso
- Problemas de produtividade por dependência da IA em momentos críticos

## Dependências
- Aprovação da identidade visual pelo Centro
- Acesso às credenciais para registro do domínio
- Definição dos papéis básicos do Centro

## Métricas de Sucesso
- 80% das tarefas concluídas dentro do prazo estendido
- Sistema de convites funcionando corretamente
- Funcionalidades básicas implementadas sem bugs críticos
- Aprovação do cliente para os elementos entregues
