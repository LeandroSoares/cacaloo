
# 📚 Documentação do Sistema Cacaloo
**Casa de Caridade Legião de Oxóssi e Ogum**

---

## 🎯 **NOVA ESTRUTURA UNIFICADA** ✨

### **📋 Documentos Principais** (LEITURA OBRIGATÓRIA)
- **[DOCUMENTACAO_UNIFICADA_INDICE.md](DOCUMENTACAO_UNIFICADA_INDICE.md)** - 📚 **Guia de navegação completo**
- **[DOCUMENTACAO_TECNICA_COMPLETA.md](DOCUMENTACAO_TECNICA_COMPLETA.md)** - 👨‍💻 **Para desenvolvedores**  
- **[PLANEJAMENTO_EXECUCAO_CONTROLE.md](PLANEJAMENTO_EXECUCAO_CONTROLE.md)** - 📊 **Para gestores**
- **[especificacoes-features/](especificacoes-features/)** - 👥 **Para usuários finais**

### **🛠️ Orientações e Suporte**
- **[GUIA_AGENTES_IA.md](GUIA_AGENTES_IA.md)** - Instruções para agentes trabalhando no projeto
- **[DEPLOY.md](DEPLOY.md)** - Configurações de produção e deploy
- **[MAILHOG_SETUP.md](MAILHOG_SETUP.md)** - Setup de desenvolvimento

### **📊 Planejamento Futuro**
- **[Sistema de Conteúdo Dinâmico](especificacoes-features/sistema-conteudo-dinamico.md)** - Especificação para homepage dinâmica
- **[feedback-de-usuarios/](feedback-de-usuarios/)** - Feedback e melhorias

---

## 🏗️ **VISÃO GERAL RÁPIDA**

### **Status Atual: ✅ Sistema Produção v2.1**
- **✅ 100% do Excel substituído** - 15 formulários Livewire funcionais
- **✅ Sistema de convites completo** - Específicos + anônimos + WhatsApp  
- **✅ CRUD administrativo** - 4 entidades com gestão completa
- **✅ 6 níveis de acesso** - Guest → User → Aluno → Manager → Admin → SysAdmin
- **✅ Feature flags** - Controle dinâmico de funcionalidades

### **Para Começar Rapidamente:**
1. **👨‍💻 Desenvolvedores:** Leiam [DOCUMENTACAO_TECNICA_COMPLETA.md](DOCUMENTACAO_TECNICA_COMPLETA.md)
2. **📊 Gestores:** Consultem [PLANEJAMENTO_EXECUCAO_CONTROLE.md](PLANEJAMENTO_EXECUCAO_CONTROLE.md)
3. **👥 Usuários:** Naveguem em [especificacoes-features/](especificacoes-features/)
4. **🆘 Dúvidas:** Vejam [DOCUMENTACAO_UNIFICADA_INDICE.md](DOCUMENTACAO_UNIFICADA_INDICE.md)
- **📅 Fase 5:** Gestão avançada de cursos e participação (FUTURO)

---

## 🚀 **TECNOLOGIAS**

- **Backend:** Laravel 12.25.0 + PHP 8.4.11
- **Frontend:** Blade + Tailwind CSS + Alpine.js
- **Interatividade:** Laravel Livewire 3.x
- **Banco:** MySQL/MariaDB com UUIDs
- **Autenticação:** Laravel Breeze + Spatie Permission
- **Deploy:** Docker + Docker Compose

---

## 📁 **ESTRUTURA DA DOCUMENTAÇÃO**

```
docs/
├── README.md                        # Este arquivo (índice principal)
├── STATUS_ATUAL_PROJETO.md          # 🎯 Status executivo (Nov 2025)
├── GUIA_AGENTES_IA.md              # 🤖 Guia para agentes de IA
├── README_COMPLETO.md               # Documentação técnica completa
├── ARQUITETURA.md                   # Padrões e estrutura de código
├── AUTENTICACAO.md                  # Segurança e permissões
├── FORMULARIOS_ESPIRITUAIS.md       # 15 Formulários Livewire
├── CRUD_ADMIN_SYSTEM.md            # Sistema CRUD Admin completo
├── formulario-principal.md          # Formulário Excel original (ref)
├── DEPLOY.md                        # Produção e deploy
├── DESIGN_SYSTEM.md                 # Sistema de design
├── historias.md                     # Histórias de usuário
├── features/                        # Funcionalidades por área
├── especificacoes-features/         # Especificações detalhadas features
└── historicos/                      # Documentos obsoletos
```

---

## 🎯 **INÍCIO RÁPIDO PARA AGENTES DE IA**

### **1. Leitura Obrigatória:**
1. **[GUIA_AGENTES_IA.md](GUIA_AGENTES_IA.md)** - Instruções específicas
2. **[README_COMPLETO.md](README_COMPLETO.md)** - Contexto geral
3. **[ARQUITETURA.md](ARQUITETURA.md)** - Padrões de código

### **2. Identificar Área de Trabalho:**
- Qual área? (public/user/admin/sysadmin)
- Qual fase? (1-5)
- Que funcionalidade?

### **3. Seguir Padrões:**
- Controllers magros
- Services para lógica
- Form Requests para validação
- Livewire para interatividade
- UUIDs obrigatórios
- Design system espiritual

---

## 🔐 **SISTEMA DE SEGURANÇA**

### **Papéis (Roles):**
- **👤 User** - Usuários básicos (área logada)
- **🛠️ Admin** - Administradores (convites, homepage, eventos)
- **⚙️ SysAdmin** - Super admins (controle total)

### **Acesso por Convite:**
- ❌ **Registro livre PROIBIDO**
- ✅ **Apenas pessoas convidadas**
- 🔒 **Tokens seguros com expiração**

---

## 🎨 **IDENTIDADE VISUAL**

### **Cores Espirituais:**
- **Oxóssi Verde:** `#2E7D32` (principal)
- **Ogum Vermelho:** `#C62828` (força)
- **Ouro Sagrado:** `#D4AF37` (elevação)
- **Verde Floresta:** `#1B4332` (profundidade)

### **Responsividade:**
- **Mobile-first** obrigatório
- **Tailwind CSS** para estilização
- **Alpine.js** para interatividade

---

## 📊 **MÉTRICAS ATUAIS** (Novembro 2025)

- **Linhas de Código:** ~18.000+
- **Models Eloquent:** 25+
- **Formulários Livewire:** 15 (com edição/exclusão)
- **Controllers Admin:** 4 CRUD completos
- **Views Admin:** 16 (4 entidades × 4 views cada)
- **Seeders:** 5 (com dados padrão do Excel)
- **Cobertura Formulário Excel:** 100%

---

## 🔄 **WORKFLOW DE DESENVOLVIMENTO**

### **Para Qualquer Mudança:**
1. **Ler documentação** (especialmente GUIA_AGENTES_IA.md)
2. **Identificar contexto** (área, fase, funcionalidade)
3. **Seguir padrões** arquiteturais estabelecidos
4. **Implementar com segurança** (middleware, validação)
5. **Testar completamente** (diferentes papéis)
6. **Manter responsividade** mobile-first
7. **Documentar mudanças** significativas

---

**🌿⚔️ Sistema desenvolvido com axé e tecnologia para a Casa de Caridade! ✨**

---

*Documentação atualizada em: 02/11/2025*  
*Sistema Cacaloo v2.1 - Laravel 12.25.0 - CRUD Admin Completo*
