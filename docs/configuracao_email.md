# Configurações de E-mail - Sistema CACALOO

Este documento detalha as configurações de e-mail para os diferentes ambientes do sistema CACALOO.

## Ambiente Local (Desenvolvimento)

- **Driver**: log
- **Configuração no .env**:
  ```
  MAIL_MAILER=log
  MAIL_SCHEME=null
  MAIL_HOST=smtp.mailtrap.io
  MAIL_PORT=2525
  MAIL_USERNAME=null
  MAIL_PASSWORD=null
  MAIL_FROM_ADDRESS="sistema@cacaloo.com.br"
  MAIL_FROM_NAME="${APP_NAME}"
  ```
- **Comportamento**: Os e-mails não são enviados, mas salvos em arquivos de log em `storage/logs/laravel.log`
- **Como testar**: 
  - Verifique o arquivo de log após uma ação que gere e-mail
  - O conteúdo completo do e-mail será registrado para inspeção

## Ambiente de Homologação (VPS Ubuntu)

- **Driver**: smtp
- **Configuração recomendada para .env**:
  ```
  MAIL_MAILER=smtp
  MAIL_SCHEME=tls
  MAIL_HOST=smtp.mailtrap.io (ou outro serviço de teste de e-mail)
  MAIL_PORT=2525 (ou a porta apropriada)
  MAIL_USERNAME=seu_usuario_mailtrap
  MAIL_PASSWORD=sua_senha_mailtrap
  MAIL_FROM_ADDRESS="sistema@cacaloo.com.br"
  MAIL_FROM_NAME="${APP_NAME}"
  ```
- **Opções**:
  1. **Mailtrap.io**: Serviço para capturar e-mails em ambiente de teste sem envio real
  2. **Mailhog**: Pode ser instalado no VPS para capturar e-mails localmente
  3. **Provedor de e-mail real**: Configurar com limites para evitar envios acidentais em massa

## Ambiente de Produção (Hospedagem Compartilhada)

- **Driver**: smtp
- **Configuração recomendada para .env**:
  ```
  MAIL_MAILER=smtp
  MAIL_SCHEME=tls
  MAIL_HOST=(fornecido pelo provedor de hospedagem)
  MAIL_PORT=587 (ou conforme recomendado pelo provedor)
  MAIL_USERNAME=(conta de e-mail do domínio cacaloo.com.br)
  MAIL_PASSWORD=(senha segura)
  MAIL_FROM_ADDRESS="sistema@cacaloo.com.br"
  MAIL_FROM_NAME="CACALOO - Centro de Umbanda"
  ```
- **Considerações**:
  - Verifique as limitações de envio de e-mail da hospedagem compartilhada
  - Considere usar filas (queue) para envios em massa para evitar timeouts
  - Configure SPF, DKIM e DMARC para melhorar a entregabilidade dos e-mails

## Testes de E-mail Antes do Lançamento

Antes de liberar o sistema para uso em produção, é essencial realizar os seguintes testes:

1. **Testes de Entrega**: Verificar se os e-mails estão sendo entregues nas caixas de entrada
2. **Testes Anti-Spam**: Garantir que os e-mails não estão sendo marcados como spam
3. **Verificação de Conteúdo**: Confirmar que os templates estão sendo renderizados corretamente
4. **Teste de Links**: Verificar se os links nos e-mails funcionam corretamente
5. **Teste de Filas**: Garantir que o sistema de filas está processando os e-mails adequadamente

## Implementação do Sistema de Convites

Para o sistema de convites (Sprint 1), considere as seguintes recomendações:

1. No ambiente de desenvolvimento:
   - Implementar a lógica completa
   - Verificar os e-mails nos logs
   - Usar uma rota temporária para testar a geração de convites

2. No ambiente de homologação:
   - Testar o fluxo completo com envios reais
   - Verificar a formatação em diferentes clientes de e-mail
   - Validar o processo de aceitação de convite

3. No ambiente de produção:
   - Iniciar com um número limitado de convites
   - Monitorar a entrega e possíveis problemas
   - Escalar gradualmente conforme necessário

---

*Este documento deve ser atualizado quando as configurações reais de cada ambiente forem definidas.*
