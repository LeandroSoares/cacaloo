# 📋 Changelog - Sistema Cacaloo

Todas as mudanças importantes neste projeto serão documentadas neste arquivo.

---

## [v2.2] - 2025-12-03 🌟 **DADOS DE ORIXÁS E UI**

### ✅ **Adicionado**
- **Campo `throne`** na tabela `orishas` e no Model
- **Campos `is_right` e `is_left`** na visualização de detalhes
- **Seeder de Orixás** atualizado com dados completos (14 Orixás)
- **Dados detalhados** (texto, oferendas, tipo, trono) importados de markdown
- **Visualização aprimorada** em `admin.orishas.show`

### 🔧 **Melhorado**
- **Layout Admin** corrigido (removida margem redundante `lg:ml-64`)
- **OrishaSeeder** agora suporta inserção em lote com dados ricos
- **UI de Detalhes** mostra indicadores visuais para Direita/Esquerda

---

## [v2.1] - 2025-11-02 🎯 **CRUD ADMIN COMPLETO**

### ✅ **Adicionado**
- **Sistema CRUD Admin completo** para 4 entidades base
- **CourseController** com gestão completa de cursos
- **MysteryController** com gestão completa de mistérios  
- **OrishaController** com gestão completa de orixás
- **MagicTypeController** com gestão completa de tipos de magia
- **Form Requests** de validação para todas as entidades
- **16 Views Admin** (index/create/edit/show × 4 entidades)
- **CoursesSeeder** com 9 cursos padrão do Excel
- **MysteriesSeeder** com 10 mistérios padrão do Excel
- **Navegação administrativa** com ícones e responsividade
- **Busca e filtros** por nome e status
- **Estatísticas de uso** nas views de detalhamento
- **Documentação CRUD_ADMIN_SYSTEM.md**
- **Documentação STATUS_ATUAL_PROJETO.md**

### 🔧 **Melhorado**
- **Formulários Livewire** com funcionalidade de edição/cancelamento
- **Campo has_initiation** já existia nos cursos religiosos
- **Campo work_phone** já existia nos dados pessoais
- **Rotas administrativas** reorganizadas e expandidas
- **Documentação completa** reorganizada e atualizada

### 📊 **Métricas Atualizadas**
- **Models:** 25+ (era 20+)
- **Formulários Livewire:** 15 (era 13) 
- **Controllers:** 8+ (era 4)
- **Views:** 50+ (era 30+)
- **Linhas de código:** ~18.000+ (era ~15.000)

---

## [v2.0] - 2025-10-19 🎉 **FORMULÁRIOS ESPIRITUAIS COMPLETOS**

### ✅ **Adicionado**
- **15 Formulários Livewire** para dados mediúnicos
- **Substituição 100%** do formulário Excel original
- **PersonalDataForm** - dados pessoais completos
- **ReligiousInfoForm** - informações religiosas  
- **PriestlyFormationForm** - formação sacerdotal
- **CrowningForm** - coroações realizadas
- **HeadOrishaForm** - orixás de cabeça (6 posições)
- **ForceCrossForm** - cruzes de força (4 direções)
- **CrossingForm** - cruzamentos com entidades
- **WorkGuideForm** - guias de trabalho por linha
- **AmaciForm** - amacis recebidos
- **LastTempleForm** - último templo frequentado
- **ReligiousCourseForm** - cursos religiosos
- **EntityConsecrationForm** - consagrações de entidades
- **InitiatedMysteryForm** - mistérios iniciados
- **InitiatedOrishaForm** - orixás iniciados  
- **DivineMagicForm** - magias divinas
- **25+ Models Eloquent** com relacionamentos
- **20+ Migrations** com estrutura completa
- **MagicTypesSeeder** com tipos padrão

### 🔧 **Melhorado**
- **Interface responsiva** mobile-first
- **Validação em tempo real** com Livewire
- **Design system** com cores espirituais
- **UUIDs** em todas as chaves primárias
- **Soft deletes** onde apropriado

---

## [v1.1] - 2025-09-15 👥 **SISTEMA DE CONVITES**

### ✅ **Adicionado**
- **Sistema de convites** com tokens seguros
- **Spatie Permission** para controle de acesso
- **3 Roles:** User, Admin, SysAdmin
- **Middleware** de proteção por área
- **InvitationController** para gestão de convites
- **Área administrativa** inicial

### 🔧 **Melhorado**
- **Segurança** com autenticação obrigatória
- **Controle de acesso** por papéis
- **Interface de usuário** diferenciada por role

---

## [v1.0] - 2025-08-20 🌐 **HOMEPAGE INSTITUCIONAL**

### ✅ **Adicionado**
- **Site institucional** responsivo
- **Design system** com identidade espiritual
- **Cores temáticas:** Oxóssi Verde, Ogum Vermelho, Ouro Sagrado
- **4 Seções:** Hero, Sobre, Eventos, Contato
- **Laravel Breeze** para autenticação
- **Tailwind CSS + Alpine.js** para frontend
- **Docker** para desenvolvimento
- **HomeSectionsSeeder** com dados iniciais

### 🏗️ **Estrutura Base**
- **Laravel 12.25.0** + PHP 8.4.11
- **MySQL** com UUIDs
- **Arquitetura 4 áreas:** Público, User, Admin, SysAdmin
- **Documentação** inicial completa

---

## 📋 **Convenções de Versioning**

### **Formato:** [MAJOR.MINOR] - YYYY-MM-DD
- **MAJOR:** Mudanças significativas na arquitetura
- **MINOR:** Novas funcionalidades importantes
- **DATA:** Sempre no formato ISO (YYYY-MM-DD)

### **Tipos de Mudança:**
- **✅ Adicionado** - Novas funcionalidades
- **🔧 Melhorado** - Melhorias em funcionalidades existentes  
- **🐛 Corrigido** - Correções de bugs
- **🗑️ Removido** - Funcionalidades removidas
- **⚠️ Depreciado** - Funcionalidades que serão removidas
- **🔒 Segurança** - Correções de vulnerabilidades

---

## 🎯 **Próximas Versões Planejadas**

### **[v2.2] - 2025-12-XX 📅 CALENDÁRIO DE EVENTOS**
- Sistema de eventos recorrentes
- Giras semanais e mensais  
- Controle de presença
- Notificações para participantes

### **[v2.3] - 2026-01-XX 📊 DASHBOARDS ADMINISTRATIVOS**
- Relatórios de participação
- Métricas de uso do sistema
- Dashboards interativos
- Exportação de dados

### **[v3.0] - 2026-06-XX 🚀 GESTÃO AVANÇADA**
- Sistema de certificados
- Controle financeiro básico
- API REST para integrações
- App mobile companion

---

*Changelog mantido seguindo [Keep a Changelog](https://keepachangelog.com/)*  
*Sistema Cacaloo - Casa de Caridade Legião de Oxóssi e Ogum*
