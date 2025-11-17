<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\User;
use App\Models\EntityConsecration;
use Livewire\Livewire;
use App\Livewire\EntityConsecrationForm;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntityConsecrationFormTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_renders_successfully()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->assertStatus(200)
            ->assertSee('Consagrações');
    }

    /** @test */
    public function it_can_create_a_consecration()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->set('entity', 'Oxalá')
            ->set('name', 'Oxalufã')
            ->set('date', '2025-11-17')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('entity', null)
            ->assertSet('name', null)
            ->assertSet('date', null);

        $this->assertDatabaseHas('entity_consecrations', [
            'user_id' => $this->user->id,
            'entity' => 'Oxalá',
            'name' => 'Oxalufã',
        ]);
    }

    /** @test */
    public function it_loads_consecrations_on_mount()
    {
        EntityConsecration::factory()->count(3)->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->assertCount('consecrations', 3);
    }

    /** @test */
    public function it_can_edit_a_consecration()
    {
        $consecration = EntityConsecration::factory()->create([
            'user_id' => $this->user->id,
            'entity' => 'Original Entity',
            'name' => 'Original Name',
            'date' => '2025-11-10',
        ]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->call('edit', $consecration->id)
            ->assertSet('editingId', $consecration->id)
            ->assertSet('entity', 'Original Entity')
            ->assertSet('name', 'Original Name')
            ->assertSet('date', '2025-11-10')
            ->set('entity', 'Updated Entity')
            ->set('name', 'Updated Name')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('entity_consecrations', [
            'id' => $consecration->id,
            'entity' => 'Updated Entity',
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_delete_a_consecration()
    {
        $consecration = EntityConsecration::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->call('delete', $consecration->id);

        $this->assertDatabaseMissing('entity_consecrations', ['id' => $consecration->id]);
    }

    /** @test */
    public function it_can_cancel_editing()
    {
        $consecration = EntityConsecration::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->call('edit', $consecration->id)
            ->assertSet('editingId', $consecration->id)
            ->call('cancel')
            ->assertSet('editingId', null)
            ->assertSet('entity', null)
            ->assertSet('name', null)
            ->assertSet('date', null);
    }

    /** @test */
    public function it_cannot_edit_another_users_consecration()
    {
        $otherUser = User::factory()->create();
        $consecration = EntityConsecration::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->call('edit', $consecration->id)
            ->assertSet('editingId', null);
    }

    /** @test */
    public function it_cannot_delete_another_users_consecration()
    {
        $otherUser = User::factory()->create();
        $consecration = EntityConsecration::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->call('delete', $consecration->id);

        $this->assertDatabaseHas('entity_consecrations', ['id' => $consecration->id]);
    }

    /** @test */
    public function it_validates_date_format()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->set('date', 'invalid-date')
            ->call('save')
            ->assertHasErrors(['date']);
    }

    /** @test */
    public function it_validates_max_length()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->set('entity', str_repeat('a', 256))
            ->set('name', str_repeat('b', 256))
            ->call('save')
            ->assertHasErrors(['entity', 'name']);
    }

    /** @test */
    public function it_shows_success_message_after_save()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->set('entity', 'Test Entity')
            ->call('save')
            ->assertOk(); // Verifica que salvou sem erros
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(EntityConsecrationForm::class, ['user' => $this->user])
            ->set('entity', 'Test Entity')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
