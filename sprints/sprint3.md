# Sprint 3: Histórico e Pagamentos

## Objetivo
Implementar o sistema de histórico dos médiuns e o gerenciamento básico de mensalidades, proporcionando controle financeiro essencial.

## Duração
3 semanas (ajustado para desenvolvedor solo com suporte de IA)

## Tarefas

### 1. Página de Histórico do Médium
- **Descrição**: Desenvolver uma página detalhada que exiba o histórico completo de cada médium no Centro.
- **Atividades**:
  - Modelar estrutura de dados para armazenar histórico
  - Criar visualização cronológica de eventos e participações
  - Implementar sistema de categorização de eventos históricos
  - Desenvolver filtros e busca no histórico
  - Criar sistema de destaque para eventos importantes
- **Critérios de Aceitação**:
  - Histórico completo visível e organizado cronologicamente
  - Filtros funcionam corretamente para diferentes tipos de eventos
  - Médiuns podem visualizar apenas seu próprio histórico
  - Administradores podem ver e gerenciar o histórico de todos

### 2. Sistema de Registro de Mensalidades
- **Descrição**: Implementar um sistema para registro e controle de mensalidades pagas pelos médiuns.
- **Atividades**:
  - Criar estrutura de dados para registro financeiro
  - Desenvolver interface para lançamento de pagamentos
  - Implementar geração de recibos automáticos
  - Criar sistema de valores diferenciados por categoria
  - Desenvolver relatórios de pagamentos recebidos
- **Critérios de Aceitação**:
  - Pagamentos são registrados corretamente com data e valor
  - Sistema permite diferentes formas de pagamento
  - Recibos podem ser gerados e enviados automaticamente
  - Interface intuitiva para lançamento rápido de múltiplos pagamentos

### 3. Visualização de Pagamentos
- **Descrição**: Criar interface para visualização de pagamentos pendentes e realizados, tanto para administradores quanto para médiuns.
- **Atividades**:
  - Desenvolver dashboard de status financeiro
  - Implementar notificações de pagamentos pendentes
  - Criar visualização de histórico de pagamentos
  - Desenvolver filtros e busca de transações
  - Implementar exportação de relatórios financeiros
- **Critérios de Aceitação**:
  - Administradores têm visão clara dos pagamentos pendentes
  - Médiuns podem verificar seu próprio histórico de pagamentos
  - Sistema identifica claramente atrasos e pagamentos em dia
  - Relatórios financeiros são precisos e facilmente exportáveis

### 4. Gestão de Médiuns Afastados
- **Descrição**: Criar funcionalidade para gerenciar médiuns temporariamente ou permanentemente afastados do Centro.
- **Atividades**:
  - Desenvolver sistema de marcação de status (ativo/afastado)
  - Implementar registro de motivos e período de afastamento
  - Criar fluxo para retorno de médiuns afastados
  - Desenvolver relatórios de médiuns afastados
  - Implementar impacto do afastamento nas obrigações financeiras
- **Critérios de Aceitação**:
  - Sistema permite marcar médiuns como afastados com motivo e data
  - Regras de pagamento de mensalidade respeitam status de afastamento
  - Médiuns afastados são claramente identificados em relatórios
  - Processo de reintegração está documentado e implementado

### 5. Relatórios Financeiros Básicos
- **Descrição**: Desenvolver relatórios financeiros essenciais para gestão do Centro.
- **Atividades**:
  - Criar relatório de receitas mensais/anuais
  - Implementar relatório de inadimplência
  - Desenvolver gráficos de evolução financeira
  - Criar relatório de previsão de receitas
  - Implementar exportação de dados financeiros
- **Critérios de Aceitação**:
  - Relatórios exibem dados precisos e atualizados
  - Gráficos são intuitivos e auxiliam na tomada de decisão
  - Dados podem ser filtrados por período e categoria
  - Exportação funciona corretamente em diferentes formatos

## Riscos
- Segurança de dados financeiros sensíveis
- Complexidade na modelagem de regras de negócio para pagamentos
- Resistência de médiuns ao novo sistema financeiro
- Integração com sistema contábil existente

## Dependências
- Conclusão da Sprint 2 com cadastro de médiuns
- Definição clara das regras de mensalidade e isenções
- Política de afastamento definida pela diretoria do Centro
- Acesso aos históricos de pagamentos anteriores

## Métricas de Sucesso
- 95% dos pagamentos do mês registrados no sistema
- Redução de 30% no tempo gasto com gestão financeira manual
- Feedback positivo dos tesoureiros sobre facilidade de uso
- Zero discrepâncias entre pagamentos registrados e valores em caixa
