---
name: livewire-3-expert
description: Expert guide for building reactive interfaces with Livewire 3.
---

# Livewire 3 Expert Skill

## 1. Component Structure
Keep logic simple. Use **Form Objects** for complex inputs. Use `updateOrCreate` for single-record-per-user forms.

```php
class ProfileForm extends Component
{
    public $name;
    public $email;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $data = Profile::where('user_id', auth()->id())->first();
        if ($data) $this->fill($data->toArray());
    }

    public function save()
    {
        $validated = $this->validate();
        Profile::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        session()->flash('message', 'Saved successfully!');
    }
}
```

## 2. Properties & Security
- **Type Hints**: Always type hint properties.
- **Locked Properties**: Use `#[Locked]` for IDs or read-only data.

```php
use Livewire\Attributes\Locked;

class ShowResource extends Component
{
    #[Locked]
    public string $resourceId;
    
    public string $title;
}
```

## 3. Optimization
- **Lazy Loading**: Use `lazy` for heavy components.
```blade
<livewire:user-statistics lazy />
```
- **Defer Updates**: Use `wire:model.blur` to reduce requests.
```blade
<input type="text" wire:model.blur="email">
```

## 4. Computed Properties
Use `#[Computed]` for derived data. Cached per request.

```php
use Livewire\Attributes\Computed;

#[Computed]
public function activeUsers()
{
    return User::where('active', true)->get();
}
```

## 5. AlpineJS Integration
Use Alpine for client-only UI (modals, dropdowns, tooltips).

```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-transition class="bg-white shadow-lg">
        Content here...
    </div>
</div>
```

## 6. Feedback Messages
Always provide user feedback with flash messages.

```php
// In Component
session()->flash('message', 'Operation successful!');
session()->flash('error', 'Something went wrong.');
```

```blade
{{-- In View --}}
@if (session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('message') }}
    </div>
@endif
```
