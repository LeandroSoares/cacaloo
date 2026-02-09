<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Orisha;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OrishaTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create permissions
        Permission::create(['name' => 'view orishas']);
        Permission::create(['name' => 'create orishas']);
        Permission::create(['name' => 'edit orishas']);
        Permission::create(['name' => 'delete orishas']);

        // Create admin role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'view orishas',
            'create orishas',
            'edit orishas',
            'delete orishas'
        ]);

        // Create admin user
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_view_orisha_edit_page()
    {
        $orisha = Orisha::create([
            'name' => 'Exu',
            'description' => 'Mensageiro',
            'type_orisha' => 'Universal',
            'throne' => 'Geração',
            'oferings' => 'Padê',
            'is_left' => true,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.orishas.edit', $orisha));

        $response->assertStatus(200);
        $response->assertSee('Exu');
        $response->assertSee('Universal');
    }

    public function test_admin_can_update_orisha()
    {
        $orisha = Orisha::create([
            'name' => 'Ogum',
            'type_orisha' => 'Universal',
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.orishas.update', $orisha), [
                'name' => 'Ogum Megê',
                'type_orisha' => 'Universal',
                'throne' => 'Lei',
                'description' => 'Orixá da Lei',
                'oferings' => 'Inhame',
                'active' => true,
            ]);

        $response->assertRedirect(route('admin.orishas.index'));

        $this->assertDatabaseHas('orishas', [
            'id' => $orisha->id,
            'name' => 'Ogum Megê',
            'throne' => 'Lei',
            'oferings' => 'Inhame',
        ]);
    }
}
