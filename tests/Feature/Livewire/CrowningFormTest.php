<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CrowningForm;
use App\Models\Crowning;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CrowningFormTest extends TestCase
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
            ->test(CrowningForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_create_a_crowning()
    {
        Livewire::actingAs($this->user)
            ->test(CrowningForm::class, ['user' => $this->user])
            ->set('temple_name', 'Templo Teste')
            ->set('guide_name', 'Caboclo Pena Branca')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('crownings', [
            'user_id' => $this->user->id,
            'temple_name' => 'Templo Teste',
        ]);
    }

    /** @test */
    public function it_can_edit_a_crowning()
    {
        $crowning = Crowning::factory()->create([
            'user_id' => $this->user->id,
            'temple_name' => 'Original Temple',
        ]);

        Livewire::actingAs($this->user)
            ->test(CrowningForm::class, ['user' => $this->user])
            ->set('temple_name', 'Updated Temple')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('crownings', [
            'id' => $crowning->id,
            'temple_name' => 'Updated Temple',
        ]);
    }

    /** @test */
    public function it_cannot_edit_another_users_crowning()
    {
        $otherUser = User::factory()->create();
        Crowning::factory()->create(['user_id' => $otherUser->id]);

        // Este formulário não permite edição de outros usuários pois busca apenas do auth()->id()
        Livewire::actingAs($this->user)
            ->test(CrowningForm::class, ['user' => $this->user])
            ->assertSet('temple_name', ''); // Deve estar vazio pois não encontrou
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(CrowningForm::class, ['user' => $this->user])
            ->set('temple_name', 'Test')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
