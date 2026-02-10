<?php

namespace Tests\Feature\Livewire;

use App\Livewire\WorkGuideForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WorkGuideFormTest extends TestCase
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
            ->test(WorkGuideForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_save_work_guides()
    {
        Livewire::actingAs($this->user)
            ->test(WorkGuideForm::class, ['user' => $this->user])
            ->set('caboclo', 'Caboclo Pena Branca')
            ->set('exu', 'Exu Tranca Ruas')
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas('work_guides', [
            'user_id' => $this->user->id,
            'caboclo' => 'Caboclo Pena Branca',
            'exu' => 'Exu Tranca Ruas',
        ]);
    }

    /** @test */
    public function it_validates_max_length()
    {
        Livewire::actingAs($this->user)
            ->test(WorkGuideForm::class, ['user' => $this->user])
            ->set('caboclo', str_repeat('a', 256))
            ->call('save')
            ->assertHasErrors(['caboclo']);
    }

    /** @test */
    public function it_dispatches_profile_updated_event()
    {
        Livewire::actingAs($this->user)
            ->test(WorkGuideForm::class, ['user' => $this->user])
            ->set('caboclo', 'Test')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
