<?php

namespace Tests\Feature\Admin;

use App\Models\DailyMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DailyMessageTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create permissions
        Permission::create(['name' => 'view daily messages']);
        Permission::create(['name' => 'create daily messages']);
        Permission::create(['name' => 'edit daily messages']);
        Permission::create(['name' => 'delete daily messages']);

        // Create admin role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'view daily messages',
            'create daily messages',
            'edit daily messages',
            'delete daily messages',
        ]);

        // Create admin user
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_view_daily_messages_list()
    {
        DailyMessage::factory()->create([
            'title' => 'Test Message',
            'message' => 'This is a test message content.',
            'author' => 'Test Author',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.daily-messages.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Message');
        $response->assertSee('Test Author');
        // This asserts the fix: ensure we don't see error about missing content attribute
        $response->assertSee('This is a test message content.');
    }

    public function test_admin_can_view_daily_message_details()
    {
        $dailyMessage = DailyMessage::factory()->create([
            'title' => 'Detail Message',
            'message' => 'Detail Content',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.daily-messages.show', $dailyMessage));

        $response->assertStatus(200);
        $response->assertSee('Detail Message');
        $response->assertSee('Detail Content');
    }
}
