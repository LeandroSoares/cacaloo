<?php

namespace Tests\Feature\Livewire;

use App\Livewire\LastTempleForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LastTempleFormTest extends TestCase
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
            ->test(LastTempleForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_save_last_temple()
    {
        Livewire::actingAs($this->user)
            ->test(LastTempleForm::class, ['user' => $this->user])
            ->set('name', 'Templo Anterior')
            ->set('leader_name', 'Pai João')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('last_temples', [
            'user_id' => $this->user->id,
            'name' => 'Templo Anterior',
        ]);
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(LastTempleForm::class, ['user' => $this->user])
            ->set('name', 'Test')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
