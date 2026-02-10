<?php

namespace Tests\Feature\User;

use App\Models\Course;
use App\Models\ReligiousCourse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediumHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_medium_history_with_religious_courses()
    {
        $user = User::factory()->create();

        $course = Course::factory()->create(['name' => 'Umbanda Basics']);

        ReligiousCourse::factory()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'date' => now()->subMonths(6),
            'finished' => true,
        ]);

        $response = $this->actingAs($user)
            ->get(route('user.medium-history'));

        $response->assertStatus(200);
        $response->assertSee('Umbanda Basics');
        $response->assertSee(now()->subMonths(6)->format('d/m/Y'));
        // Verify that it does NOT show error about missing start_date
    }

    public function test_user_can_view_medium_history_with_unfinished_course()
    {
        $user = User::factory()->create();

        $course = Course::factory()->create(['name' => 'Advanced Mediumship']);

        ReligiousCourse::factory()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'date' => now()->subMonths(1),
            'finished' => false,
        ]);

        $response = $this->actingAs($user)
            ->get(route('user.medium-history'));

        $response->assertStatus(200);
        $response->assertSee('Advanced Mediumship');
        $response->assertSee('(em andamento)');
    }
}
