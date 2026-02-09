<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AmaciForm;
use App\Models\Amaci;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AmaciFormTest extends TestCase
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
            ->test(AmaciForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_create_an_amaci()
    {
        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->set('type', 'Amaci de Oxalá')
            ->set('date', '2024-01-15')
            ->set('observations', 'Teste de observações')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('amacis', [
            'user_id' => $this->user->id,
            'type' => 'Amaci de Oxalá',
            'observations' => 'Teste de observações',
        ]);
    }

    /** @test */
    public function it_loads_amacis_on_mount()
    {
        Amaci::factory()->count(3)->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->assertCount('amacis', 3);
    }

    /** @test */
    public function it_can_edit_an_amaci()
    {
        $amaci = Amaci::factory()->create([
            'user_id' => $this->user->id,
            'type' => 'Original Type',
        ]);

        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->call('edit', $amaci->id)
            ->assertSet('editingId', $amaci->id)
            ->assertSet('type', 'Original Type')
            ->set('type', 'Updated Type')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('amacis', [
            'id' => $amaci->id,
            'type' => 'Updated Type',
        ]);
    }

    /** @test */
    public function it_can_delete_an_amaci()
    {
        $amaci = Amaci::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->call('delete', $amaci->id)
            ->assertOk();

        $this->assertDatabaseMissing('amacis', ['id' => $amaci->id]);
    }

    /** @test */
    public function it_can_cancel_editing()
    {
        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->set('type', 'Test Type')
            ->set('editingId', 999)
            ->call('cancel')
            ->assertSet('type', null)
            ->assertSet('editingId', null);
    }

    /** @test */
    public function it_cannot_edit_another_users_amaci()
    {
        $otherUser = User::factory()->create();
        $amaci = Amaci::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->call('edit', $amaci->id)
            ->assertSet('editingId', null);
    }

    /** @test */
    public function it_cannot_delete_another_users_amaci()
    {
        $otherUser = User::factory()->create();
        $amaci = Amaci::factory()->create(['user_id' => $otherUser->id]);

        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->call('delete', $amaci->id);

        $this->assertDatabaseHas('amacis', ['id' => $amaci->id]);
    }

    /** @test */
    public function it_validates_date_format()
    {
        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->set('date', 'invalid-date')
            ->call('save')
            ->assertHasErrors(['date']);
    }

    /** @test */
    public function it_validates_max_length()
    {
        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->set('type', str_repeat('a', 256))
            ->call('save')
            ->assertHasErrors(['type']);
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(AmaciForm::class, ['user' => $this->user])
            ->set('type', 'Test Type')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
