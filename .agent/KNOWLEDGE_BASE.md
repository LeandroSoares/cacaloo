# Base de Conhecimento - Sistema CACALOO

## 1. Identidade e Propósito
**CACALOO** (Casa de Caridade Legião de Oxóssi e Ogum) é um sistema ERP desenvolvido para a gestão completa de um Centro de Umbanda Sagrada.
- **Missão:** Digitalizar e organizar a administração da casa, desde o cadastro de médiuns até a gestão financeira e educacional, mantendo o respeito às tradições e hierarquias espirituais.
- **Contexto:** Ambiente religioso/espiritual. A terminologia e o design devem refletir respeito e seriedade.

## 2. Público Alvo e Hierarquia
O sistema possui níveis de acesso estritos baseados na hierarquia da casa:

| Nível | Descrição | Permissões Chave |
| :--- | :--- | :--- |
| **Guest** | Visitante Público | Acesso apenas à homepage institucional e contato. |
| **Aluno** | Estudante | Área isolada (`/aluno`). Acesso apenas a cursos matriculados. Sem acesso a dados da casa. |
| **User** | Médium/Membro | Acesso ao Portal (`/portal`). Gerencia dados pessoais, preenche formulários espirituais. |
| **Manager** | Gerente | Acesso administrativo limitado. Visualiza usuários (dados simples), cria convites básicos. |
| **Admin** | Administrador | Gestão da casa. Cria convites, gerencia eventos, cursos e conteúdo. |
| **SysAdmin** | Super Admin | Controle técnico total. Edição de qualquer dado, gestão de permissões e feature flags. |

## 3. Stack Tecnológico
- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Laravel Livewire 3, TailwindCSS (v3/v4), AlpineJS, Vite.
- **Banco de Dados:** MySQL (Produção), SQLite (Dev/Test). Uso obrigatório de **UUIDs**.
- **Autenticação:** Laravel Breeze + Spatie Laravel Permission.
- **Infra:** Docker, Nginx.

## 4. Funcionalidades Detalhadas

### 4.1. Formulários Espirituais (15 Módulos)
O coração do sistema é a digitalização da vida mediúnica. Tabelas e Forms principais:
1.  **Dados Pessoais:** (`personal_data`) - Cadastro civil completo.
2.  **Infos Religiosas:** (`religious_infos`) - Datas de batismo, entrada na casa.
3.  **Coroações:** (`crownings`) - Histórico de coroações com guias.
4.  **Orixás de Cabeça:** (`head_orishas`) - Frente, Ancestral, Juntó, Adjunto.
5.  **Guias de Trabalho:** (`work_guides`) - Mapeamento das entidades (Caboclo, Exu, etc.).
6.  **Outros:** Formação Sacerdotal, Cruzes de Força, Cruzamentos, Amacis, Último Templo, Cursos, Consagrações, Mistérios, Magias Divinas.

### 4.2. Sistema de Convites
Acesso rigorosamente controlado.
- **Tipos:**
    - **Específico:** Vinculado a email. Seguro.
    - **Anônimo:** Link compartilhável (WhatsApp). Gera token único.
- **Integração:** Formatação automática de mensagens para WhatsApp.
- **Segurança:** Tokens expiram (7-30 dias). Atribuição automática de perfil (User/Admin) no registro.

### 4.3. Infraestrutura & Deploy
- **Ambiente:** Docker (App, Nginx, MySQL, Redis, Queue, Scheduler).
- **Servidor:** PHP 8.4 (Alpine), Nginx.
- **Domínio:** `casadecaridade.com.br`.
- **Rotinas:** Backup diário automático (Banco + Storage) para local seguro.

## 5. Contexto Espiritual (Regras de Design)
- **Regência:** Casa de **Oxóssi** (Conhecimento/Verde) e **Ogum** (Lei/Vermelho).
- **Filosofia:** O sistema deve refletir organização e conhecimento ("O cientista e doutrinador"). Evitar caos visual.
- **Segurança Espiritual:** Dados de "Orixás de Cabeça" e "Guias" são sagrados. Apenas o próprio médium e a liderança podem ver. **Nunca** expor publicamente.

### 5.1. Paleta de Cores Obrigatória
```css
/* Cores Principais */
.oxossi  { color: #2E7D32; }  /* Verde - Conhecimento/Natureza */
.ogum    { color: #C62828; }  /* Vermelho - Lei/Força */
.gold    { color: #D4AF37; }  /* Dourado Sagrado */
.forest  { color: #1B4332; }  /* Verde Floresta */

/* Tons Neutros */
.bg-light { background: #F5F5F5; }
.bg-dark  { background: #1A1A1A; }
```
- **Mobile-First**: Todas as interfaces devem ser responsivas desde o início.
- **WCAG AA**: Garantir contraste adequado para acessibilidade.

## 6. Referências de Documentação
Para detalhes técnicos aprofundados, consulte sempre os arquivos no projeto (são a fonte da verdade):
- `docs/GUIA_AGENTES_IA.md`: **LEITURA OBRIGATÓRIA** para agentes.
- `docs/DOCUMENTACAO_TECNICA_COMPLETA.md`: Detalhes de arquitetura, tabelas e regras de negócio.
- `docs/especificacoes-features/`: Detalhes granulares de cada feature.
