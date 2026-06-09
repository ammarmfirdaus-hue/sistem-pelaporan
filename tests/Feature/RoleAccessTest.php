<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_petugas_user(): void
    {
        $this->post('/register', [
            'name' => 'Petugas Baru',
            'email' => 'petugas-baru@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'petugas-baru@example.com',
            'role' => 'petugas',
        ]);
    }

    public function test_petugas_login_redirects_to_report_form(): void
    {
        User::factory()->create([
            'email' => 'petugas@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
        ]);

        $this->post('/login', [
            'email' => 'petugas@example.com',
            'password' => 'password123',
        ])->assertRedirect('/laporan/create');
    }

    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ])->assertRedirect('/admin/dashboard');

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Fondasi admin siap dikembangkan')
            ->assertSee('Total Posyandu')
            ->assertDontSee('Form Input')
            ->assertDontSee('Histori Data')
            ->assertDontSee('Progress Step');
    }

    public function test_role_middleware_blocks_cross_role_access(): void
    {
        $petugas = User::factory()->create(['role' => 'petugas']);
        $admin = User::factory()->admin()->create();

        $this->actingAs($petugas)
            ->get('/admin/dashboard')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/laporan/create')
            ->assertForbidden();
    }

    public function test_invalid_role_is_rejected_by_database_constraint(): void
    {
        $this->expectException(QueryException::class);

        User::query()->create([
            'name' => 'Invalid Role',
            'email' => 'invalid@example.com',
            'password' => Hash::make('password123'),
            'role' => 'operator',
        ]);
    }
}
