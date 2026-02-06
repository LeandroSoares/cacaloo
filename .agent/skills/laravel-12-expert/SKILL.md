---
name: laravel-12-expert
description: Expert guide for Laravel 12 development, patterns, and best practices.
---

# Laravel 12 Expert Skill

## 1. Core Philosophy
Laravel 12 focuses on developer experience and modern PHP features. We embrace:
- **Typed Properties**: Use strict typing in all classes.
- **Constructor Property Promotion**: Reduce boilerplate.
- **Enum Classes**: Use PHP 8.1+ Enums for status, types, and categories.
- **Readonly Classes**: Use for DTOs and Value Objects.

## 2. Modern Route Definitions
Avoid closure routes for logic. Use `Route::controller` groups.

```php
// ✅ DO THIS
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});

// ❌ AVOID THIS
Route::get('/orders/{id}', [OrderController::class, 'show']);
```

## 3. Eloquent & Database

### UUIDs
We strictly use UUIDs.
```php
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Model
{
    use HasUuids;
}
```

### Migrations
Always define foreign keys constraints.
```php
$table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
```

## 4. Service Pattern
Extract complex logic from Controllers.

```php
// Controller
public function store(StoreOrderRequest $request, CreateOrderAction $action)
{
    $order = $action->execute($request->validated());
    return to_route('orders.show', $order);
}

// Action
class CreateOrderAction
{
    public function execute(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // Complex logic here
        });
    }
}
```

## 5. Testing
Use **Pest PHP** syntax when possible (or PHPUnit with clean syntax).
- **Feature Tests**: Test endpoints, validation, and database state.
- **Unit Tests**: Test isolated logic in Services/Actions.

```php
test('user can create order', function () {
    $user = User::factory()->create();
    actingAs($user)
        ->post('/orders', ['product_id' => 1])
        ->assertRedirect('/orders/1');
});
```
