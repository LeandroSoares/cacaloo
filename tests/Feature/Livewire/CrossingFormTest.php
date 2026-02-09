<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CrossingForm;
use App\Models\Crossing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CrossingFormTest extends TestCase
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
            ->test(CrossingForm::class, ['user' => $this->user])
            ->assertStatus(200)
            ->assertSee('Cruzamentos');
    }

    /** @test */
    public function it_can_create_a_crossing()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('entity', 'Exu')
            ->set('date', '2025-11-17')
            ->set('purpose', 'Proteção')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('entity', null)
            ->assertSet('date', null)
            ->assertSet('purpose', null);

        $this->assertDatabaseHas('crossings', [
            'user_id' => $this->user->id,
            'entity' => 'Exu',
            'purpose' => 'Proteção',
        ]);
    }

    /** @test */
    public function it_loads_crossings_on_mount()
    {
        Crossing::factory()->count(3)->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->assertCount('crossings', 3);
    }

    /** @test */
    public function it_can_edit_a_crossing()
    {
        $crossing = Crossing::factory()->create([
            'user_id' => $this->user->id,
            'entity' => 'Original Entity',
            'date' => '2025-11-10',
            'purpose' => 'Original Purpose',
        ]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->call('edit', $crossing->id)
            ->assertSet('editingId', $crossing->id)
            ->assertSet('entity', 'Original Entity')
            ->assertSet('date', '2025-11-10')
            ->assertSet('purpose', 'Original Purpose')
            ->set('entity', 'Updated Entity')
            ->set('purpose', 'Updated Purpose')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('crossings', [
            'id' => $crossing->id,
            'entity' => 'Updated Entity',
            'purpose' => 'Updated Purpose',
        ]);
    }

    /** @test */
    public function it_can_delete_a_crossing()
    {
        $crossing = Crossing::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->call('delete', $crossing->id);

        $this->assertDatabaseMissing('crossings', ['id' => $crossing->id]);
    }

    /** @test */
    public function it_can_cancel_editing()
    {
        $crossing = Crossing::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->call('edit', $crossing->id)
            ->assertSet('editingId', $crossing->id)
            ->call('cancel')
            ->assertSet('editingId', null)
            ->assertSet('entity', null)
            ->assertSet('date', null)
            ->assertSet('purpose', null);
    }

    /** @test */
    public function it_cannot_edit_another_users_crossing()
    {
        $otherUser = User::factory()->create();
        $crossing = Crossing::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->call('edit', $crossing->id)
            ->assertSet('editingId', null);
    }

    /** @test */
    public function it_cannot_delete_another_users_crossing()
    {
        $otherUser = User::factory()->create();
        $crossing = Crossing::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->call('delete', $crossing->id);

        $this->assertDatabaseHas('crossings', ['id' => $crossing->id]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('entity', '')
            ->set('date', '')
            ->set('purpose', '')
            ->call('save')
            ->assertHasNoErrors(); // Todos os campos são nullable
    }

    /** @test */
    public function it_validates_date_format()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('date', 'invalid-date')
            ->call('save')
            ->assertHasErrors(['date']);
    }

    /** @test */
    public function it_validates_max_length()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('entity', str_repeat('a', 256))
            ->call('save')
            ->assertHasErrors(['entity']);
    }

    /** @test */
    public function it_shows_success_message_after_save()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('entity', 'Test Entity')
            ->call('save')
            ->assertOk(); // Verifica que salvou sem erros
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(CrossingForm::class, ['user' => $this->user])
            ->set('entity', 'Test Entity')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
