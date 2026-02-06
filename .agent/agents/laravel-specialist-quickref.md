# Laravel Specialist Quick Reference

> Project-specific patterns for Sistema Cacaloo

---

## 🏗️ Tech Stack

- **Laravel**: 12.25.0
- **PHP**: 8.4.11
- **Livewire**: 3.x
- **Database**: MySQL/MariaDB (UUIDs)
- **Frontend**: Blade + Tailwind CSS + Alpine.js
- **Package**: Spatie Permission

---

## 📊 Key Entities

### Orixás (Spiritual Deities)

**Model**: `Orisha`  
**Fields**: name, description, text, type_orisha, throne, oferings, is_right, is_left  
**Seeder**: Populated from `docs/orixas/*.md`

### Users \u0026 Permissions

**Roles**: guest, aluno, user, manager, admin, sysadmin  
**Package**: `spatie/laravel-permission`

---

## 🎨 UI Conventions

### Admin Area

**Layout**: `resources/views/layouts/admin.blade.php`  
**Sidebar**: Fixed w-64, `lg:static` (NO redundant margins)  
**Color System**: Verde Oxóssi (#2E7D32), Vermelho Ogum (#C62828)

### Badges

```blade
{{-- Active Status --}}
<span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Ativo</span>

{{-- Direita --}}
<span class="px-2 text-xs rounded-full bg-blue-100 text-blue-800">Sim</span>

{{-- Esquerda --}}
<span class="px-2 text-xs rounded-full bg-purple-100 text-purple-800">Sim</span>
```

---

## 📝 Common Patterns

### Seeder with updateOrCreate

```php
foreach ($items as $item) {
    Model::updateOrCreate(
        ['name' => $item['name']], // Unique key
        $item                      // All data
    );
}
```

### Livewire Form

```php
use Livewire\Component;

class ExampleForm extends Component
{
    public $user;
    public $field;

    public function mount()
    {
        $this->field = $this->user->field;
    }

    public function save()
    {
        $this->validate(['field' => 'required']);
        $this->user->update(['field' => $this->field]);
        session()->flash('success', 'Salvo!');
    }
}
```

---

## 🧪 Testing Checklist

- [ ] Login: `admin@cacaloo.com.br` / `cacaloo@admin123`
- [ ] Navigate to feature
- [ ] Test CRUD operations
- [ ] Verify responsive layout
- [ ] Check permissions by role

---

## 📚 Documentation

- **Main Docs**: `docs/DOCUMENTACAO_TECNICA_COMPLETA.md`
- **Features**: `docs/especificacoes-features/`
- **Changelog**: `docs/CHANGELOG.md`

---

*For full codebase patterns, see [.agent/CODEBASE.md](../CODEBASE.md)*
