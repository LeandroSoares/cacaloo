# Ambientes de Desenvolvimento CACALOO

Este documento contém informações sobre os diferentes ambientes utilizados no desenvolvimento, homologação e produção do sistema CACALOO.

## Ambiente Local

- **Descrição**: Computador pessoal do desenvolvedor
- **Sistema Operacional**: Windows
- **Web Server**: Servidor PHP integrado / Artisan serve
- **PHP**: 8.2+
- **Banco de Dados**: MySQL
- **Acesso**: Total, ambiente de desenvolvimento principal
- **URL**: http://localhost:8000
- **E-mail**: Configurado para usar driver "log" (os emails são salvos em logs e não enviados)
- **Limitações**: 
  - Sem sistema de e-mail real configurado
  - Testes de e-mail precisarão ser feitos em homologação

## Ambiente de Homologação

- **Descrição**: VPS para testes e homologação
- **Sistema Operacional**: Ubuntu
- **Web Server**: Nginx
- **PHP**: Instalado e configurado
- **Composer**: Disponível
- **Acesso**: 
  - SSH: Sim
  - FTP: Sim
  - Banco de dados: Total
- **Observações**: 
  - Utilizado para testes antes de envio para produção
  - Ambiente de demonstração para o cliente
  - Automatização de deploy a ser implementada

## Ambiente de Produção

- **Descrição**: Servidor de hospedagem compartilhada do cliente
- **Painel**: cPanel
- **Acesso**:
  - FTP: Sim
  - SSH: Solicitado, aguardando acesso
  - Banco de dados: Via cPanel
- **Limitações**: 
  - Hospedagem compartilhada pode ter restrições de recursos
  - Acesso SSH pendente, o que pode limitar automatizações
  - Configurações de servidor possivelmente restritas
- **Considerações**:
  - Será necessário testar limites de memória e processamento
  - Verificar suporte ao Laravel e suas dependências
  - Considerar estratégias para deploy sem acesso SSH

## Fluxo de Trabalho

1. **Desenvolvimento** no ambiente local
2. **Testes iniciais** no ambiente local
3. **Deploy para homologação** no VPS Ubuntu
4. **Testes de homologação** com o cliente
5. **Aprovação** para produção
6. **Deploy para produção** no servidor compartilhado

## Domínio

- **Domínio Principal**: cacaloo.com.br
- **Status**: Registrado
- **DNS**: A ser configurado para apontar para o servidor de produção

## Pendências

- Acesso SSH ao ambiente de produção
- Configuração de credenciais de e-mail de produção
- Confirmação dos limites de recursos no servidor compartilhado
- Estratégia de backup automático para todos os ambientes

## Estratégias de Deploy

### Ambiente de Homologação (VPS)
- Git pull + script de atualização
- Possibilidade de implementar CI/CD básico

### Ambiente de Produção (sem SSH)
- Upload via FTP
- Script de atualização via interface web
- Possível utilização de ferramenta especializada para deploy em ambientes compartilhados

---

*Este documento será atualizado conforme novas informações estiverem disponíveis.*
