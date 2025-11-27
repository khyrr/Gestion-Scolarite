<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Models\Enseignant;

class TeacherMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('auth.teacher')->get('/test-teacher-middleware', function () {
            return response('teacher-area');
        });
    }

    /** @test */
    public function teacher_user_can_access_route_protected_by_teacher_middleware(): void
    {
        config(['auth.guards.teacher' => ['driver' => 'session', 'provider' => 'teachers']]);

        $teacher = Enseignant::create([
            'prenom' => 'First',
            'nom' => 'Teacher',
            'email' => 'teacher@example.com',
            'telephone' => '+222000000',
            'mot_de_passe' => bcrypt('password'),
            'is_active' => true,
        ]);

        $this->actingAs($teacher, 'teacher')
             ->get('/test-teacher-middleware')
             ->assertStatus(200)
             ->assertSee('teacher-area');
    }

    /** @test */
    public function non_teacher_is_forbidden_by_teacher_middleware(): void
    {
        $user = \App\Models\User::create([
            'name' => 'U1',
            'prenom' => 'Not',
            'nom' => 'Teacher',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $this->actingAs($user, 'teacher')
             ->get('/test-teacher-middleware')
             ->assertStatus(302); // redirect to accueil
    }
}
