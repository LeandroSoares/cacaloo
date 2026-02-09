<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DivineMagicForm;
use App\Livewire\ForceCrossForm;
use App\Livewire\HeadOrishaForm;
use App\Livewire\InitiatedMysteryForm;
use App\Livewire\InitiatedOrishaForm;
use App\Livewire\PersonalDataForm;
use App\Livewire\PriestlyFormationForm;
use App\Livewire\ReligiousCourseForm;
use App\Livewire\ReligiousInfoForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RemainingFormsTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function personal_data_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(PersonalDataForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function religious_info_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(ReligiousInfoForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function priestly_formation_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(PriestlyFormationForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function force_cross_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(ForceCrossForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function head_orisha_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(HeadOrishaForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function divine_magic_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(DivineMagicForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function initiated_orisha_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(InitiatedOrishaForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function initiated_mystery_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(InitiatedMysteryForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function religious_course_form_renders()
    {
        Livewire::actingAs($this->user)
            ->test(ReligiousCourseForm::class, ['user' => $this->user])
            ->assertStatus(200);
    }

    /** @test */
    public function personal_data_form_dispatches_event()
    {
        Livewire::actingAs($this->user)
            ->test(PersonalDataForm::class, ['user' => $this->user])
            ->call('save')
            ->assertDispatched('profile-updated');
    }

    /** @test */
    public function religious_info_form_dispatches_event()
    {
        Livewire::actingAs($this->user)
            ->test(ReligiousInfoForm::class, ['user' => $this->user])
            ->call('save')
            ->assertDispatched('profile-updated');
    }

    /** @test */
    public function priestly_formation_form_dispatches_event()
    {
        Livewire::actingAs($this->user)
            ->test(PriestlyFormationForm::class, ['user' => $this->user])
            ->set('theology_start', '2020-01-01')
            ->set('priesthood_start', '2022-01-01')
            ->call('save')
            ->assertDispatched('profile-updated');
    }
}
