# Feature: Formulários Espirituais

---

## 📋 **Informações Gerais**
- **Status:** 🔄 Em Correção
- **Versão:** v2.2 (Realidade do Banco de Dados)
- **Responsável:** Equipe de desenvolvimento
- **Última Atualização:** Dezembro 2025

---

## 🎯 **Objetivo**
Documentação atualizada para refletir **exatamente** os campos existentes no banco de dados, eliminando discrepâncias com o código.

---

## 🔧 **Formulários Implementados**

### **1. 👤 Dados Pessoais**
**Tabela:** `personal_data`
```php
- name (Nome completo)
- address (Endereço)
- zip_code (CEP)
- email (Email)
- cpf (CPF)
- rg (RG)
- birth_date (Data de nascimento)
- home_phone (Telefone residencial)
- mobile_phone (Celular)
- work_phone (Telefone trabalho)
- emergency_contact (Contato de emergência)
```

### **2. 🙏 Informações Religiosas**
**Tabela:** `religious_infos`
```php
- start_date (Data de início)
- start_location (Local de início)
- charity_house_start (Início na casa de caridade)
- charity_house_end (Fim na casa de caridade)
- charity_house_observations (Observações da casa)
- development_start (Início do desenvolvimento)
- development_end (Fim do desenvolvimento)
- service_start (Início do atendimento)
- umbanda_baptism (Data do batismo)
- cambone_experience (Experiência como cambone - bool)
- cambone_start_date (Início cambone)
- cambone_end_date (Fim cambone)
```

### **3. 🎓 Formação Sacerdotal**
**Tabela:** `priestly_formations`
```php
- theology_start (Início Teologia)
- theology_end (Fim Teologia)
- priesthood_start (Início Sacerdócio)
- priesthood_end (Fim Sacerdócio)
```

### **4. 👑 Coroações**
**Tabela:** `crownings`
```php
- start_date (Data início)
- end_date (Data fim)
- guide_name (Nome do guia)
- priest_name (Nome do sacerdote)
- temple_name (Nome do templo)
```

### **5. ⚡ Orixás de Cabeça**
**Tabela:** `head_orishas`
```php
- ancestor (Ancestral)
- front (Frente)
- front_together (Juntó da Frente)
- adjunct (Adjunto)
- adjunct_together (Juntó do Adjunto)
- left_side (Esquerda)
- left_side_together (Juntó da Esquerda)
- right_side (Direita)
- right_side_together (Juntó da Direita)
```

### **6. ✨ Cruzes de Força**
**Tabela:** `force_crosses`
```php
- top (Alto)
- bottom (Embaixo)
- left (Esquerda)
- right (Direita)
```

### **7. 🔮 Cruzamentos**
**Tabela:** `crossings`
```php
- entity (Entidade)
- date (Data)
- purpose (Finalidade)
```

### **8. 👻 Guias de Trabalho**
**Tabela:** `work_guides`
```php
- caboclo
- cabocla
- ogum
- xango
- baiano
- baiana
- preto_velho
- preta_velha
- marinheiro
- ere
- exu
- pombagira
- exu_mirim
```

### **9. 🛁 Amacis**
**Tabela:** `amacis`
```php
- type (Tipo)
- observations (Observações)
- date (Data)
```

### **10. 🏛️ Último Templo**
**Tabela:** `last_temples`
```php
- name (Nome)
- address (Endereço)
- leader_name (Dirigente)
- function (Função)
- exit_reason (Motivo da saída)
```

### **11. 📚 Cursos Religiosos**
**Tabela:** `religious_courses`
```php
- course_id (FK)
- date (Data)
- finished (Finalizado - bool)
- has_initiation (Tem iniciação - bool)
- initiation_date (Data iniciação)
- observations (Observações)
```

### **12. 🌟 Consagrações de Entidades**
**Tabela:** `entity_consecrations`
```php
- entity (Entidade)
- name (Nome)
- date (Data)
```

### **13. 🔓 Mistérios Iniciados**
**Tabela:** `initiated_mysteries`
```php
- mystery_id (FK)
- date (Data)
- observations (Observações)
// Campos removidos: temple, priest_name, completed
```

### **14. ⚡ Orixás Iniciados**
**Tabela:** `initiated_orishas`
```php
- orisha_id (FK)
- initiated (Iniciado - bool)
- observations (Observações)
```

### **15. ✨ Magias Divinas**
**Tabela:** `divine_magics`
```php
- magic_type_id (FK)
- date (Data)
- temple (Templo)
- priest_name (Sacerdote)
- observations (Observações)
```