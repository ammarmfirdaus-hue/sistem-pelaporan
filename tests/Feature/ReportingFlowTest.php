<?php

namespace Tests\Feature;

use App\Models\Posyandu;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_redirects_to_login_with_status(): void
    {
        $response = $this->post('/register', [
            'name' => 'Petugas Posyandu',
            'email' => 'petugas@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['email' => 'petugas@example.com', 'role' => 'petugas']);
        $this->assertDatabaseHas('activity_logs', ['action' => 'register', 'module' => 'auth']);
    }

    public function test_auth_and_report_create_pages_render(): void
    {
        $user = User::factory()->create(['name' => 'Siti Petugas']);

        $this->get('/login')->assertOk()->assertSee('Selamat Datang')->assertSee('Daftar');
        $this->get('/register')->assertOk()->assertSee('Buat Akun Baru')->assertSee('Masuk');
        $this->actingAs($user)
            ->get('/laporan/create')
            ->assertOk()
            ->assertSee('Keluar')
            ->assertSee('Identitas Posyandu')
            ->assertSee('ID Posyandu akan dibuat otomatis');
    }

    public function test_logout_redirects_to_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_petugas_can_submit_report_and_reuses_posyandu_profile(): void
    {
        $user = User::factory()->create(['name' => 'Siti Petugas']);

        $response = $this->actingAs($user)->post('/laporan', $this->validReportPayload());

        $response->assertRedirect('/laporan/success');

        $user->refresh();
        $this->assertNotNull($user->posyandu_id);
        $this->assertDatabaseHas('posyandus', [
            'id' => $user->posyandu_id,
            'kode_internal' => 'UT-PSY-0001',
            'nama_posyandu' => 'Posyandu Melati',
        ]);
        $this->assertDatabaseHas('reports', [
            'user_id' => $user->id,
            'posyandu_id' => $user->posyandu_id,
            'nama_petugas' => 'Siti Petugas',
        ]);
        $this->assertDatabaseHas('activity_logs', ['action' => 'submit_report']);

        $secondPayload = array_merge($this->validReportPayload(), [
            'nama_posyandu' => '',
            'kecamatan' => '',
            'kelurahan' => '',
            'child_nama' => 'Budi Santoso',
        ]);

        $this->actingAs($user)->post('/laporan', $secondPayload)->assertRedirect('/laporan/success');

        $this->assertSame(1, Posyandu::count());
        $this->assertSame(2, Report::count());
    }

    public function test_petugas_can_update_existing_posyandu_identity(): void
    {
        $user = User::factory()->create(['name' => 'Siti Petugas']);

        $this->actingAs($user)->post('/laporan', $this->validReportPayload());
        $user->refresh();

        $response = $this->actingAs($user)->patch('/posyandu/identitas', [
            'nama_posyandu' => 'Posyandu Mekar',
            'kecamatan' => 'Pasirsari',
            'kelurahan' => 'Babelan',
        ]);

        $response->assertRedirect('/laporan/create');
        $this->assertSame(1, Posyandu::count());
        $this->assertDatabaseHas('posyandus', [
            'id' => $user->posyandu_id,
            'kode_internal' => 'UT-PSY-0001',
            'nama_posyandu' => 'Posyandu Mekar',
            'kecamatan' => 'Pasirsari',
            'kelurahan' => 'Babelan',
        ]);
    }

    public function test_report_detail_is_protected_from_other_users(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($owner)->post('/laporan', $this->validReportPayload());
        $report = Report::firstOrFail();

        $this->actingAs($otherUser)->get("/histori/{$report->id}")->assertForbidden();
    }

    public function test_history_only_lists_authenticated_users_reports(): void
    {
        $firstUser = User::factory()->create();
        $secondUser = User::factory()->create();

        $this->actingAs($firstUser)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Ananda Pertama',
        ]));
        $this->actingAs($secondUser)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Bayi Lain',
        ]));

        $this->actingAs($firstUser)
            ->get('/histori')
            ->assertOk()
            ->assertSee('Ananda Pertama')
            ->assertDontSee('Bayi Lain');

        $this->actingAs($firstUser)
            ->get(sprintf('/histori?month=%d&year=%d', now()->month, now()->year))
            ->assertOk()
            ->assertSee('Ananda Pertama')
            ->assertDontSee('Bayi Lain');

        $this->assertDatabaseHas('activity_logs', ['action' => 'view_history']);
    }

    public function test_history_period_filters_use_report_input_date(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Ari Mei',
        ]));
        $this->setReportCreatedAt('Ari Mei', now()->setDate(2026, 5, 10)->setTime(8, 0));

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Bima April',
        ]));
        $this->setReportCreatedAt('Bima April', now()->setDate(2026, 4, 12)->setTime(8, 0));

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Citra Mei Tahun Lalu',
        ]));
        $this->setReportCreatedAt('Citra Mei Tahun Lalu', now()->setDate(2025, 5, 8)->setTime(8, 0));

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Danu Juni',
        ]));
        $this->setReportCreatedAt('Danu Juni', now()->setDate(2026, 6, 2)->setTime(8, 0));

        $this->actingAs($user)
            ->get('/histori')
            ->assertOk()
            ->assertSeeInOrder(['Danu Juni', 'Ari Mei', 'Bima April', 'Citra Mei Tahun Lalu'])
            ->assertSee('Periode Laporan');

        $this->actingAs($user)
            ->get('/histori?month=5&year=2026')
            ->assertOk()
            ->assertSee('Ari Mei')
            ->assertDontSee('Bima April')
            ->assertDontSee('Citra Mei Tahun Lalu')
            ->assertDontSee('Danu Juni');

        $this->actingAs($user)
            ->get('/histori?month=4&year=2026')
            ->assertOk()
            ->assertDontSee('Ari Mei')
            ->assertSee('Bima April')
            ->assertDontSee('Citra Mei Tahun Lalu')
            ->assertDontSee('Danu Juni');

        $this->actingAs($user)
            ->get('/histori?month=5&year=2025')
            ->assertOk()
            ->assertDontSee('Ari Mei')
            ->assertDontSee('Bima April')
            ->assertSee('Citra Mei Tahun Lalu')
            ->assertDontSee('Danu Juni');
    }

    public function test_history_can_search_child_name_with_period_filter(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Ammar Manurung',
        ]));

        $this->actingAs($user)->post('/laporan', array_merge($this->validReportPayload(), [
            'child_nama' => 'Budi Santoso',
        ]));

        $this->actingAs($user)
            ->post('/laporan', array_merge($this->validReportPayload(), [
                'child_nama' => 'Budi Ammar',
            ]));

        $this->setReportCreatedAt('Ammar Manurung', now()->setDate(2026, 5, 10)->setTime(8, 0));
        $this->setReportCreatedAt('Budi Santoso', now()->setDate(2026, 5, 11)->setTime(8, 0));
        $this->setReportCreatedAt('Budi Ammar', now()->setDate(2026, 5, 12)->setTime(8, 0));

        $this->actingAs($user)
            ->get('/histori?month=5&year=2026&search=Am')
            ->assertOk()
            ->assertSee('Ammar Manurung')
            ->assertSee('Budi Ammar')
            ->assertSeeInOrder(['Ammar Manurung', 'Budi Ammar'])
            ->assertDontSee('Budi Santoso')
            ->assertSee('Periode Laporan')
            ->assertSee('Cari nama balita');

        $this->actingAs($user)
            ->get('/histori?month=5&year=2026&search=TidakAda')
            ->assertOk()
            ->assertSee('Data tidak ditemukan')
            ->assertSee('Coba gunakan nama balita lain atau ubah periode laporan.');
    }

    private function setReportCreatedAt(string $childName, mixed $createdAt): void
    {
        Report::whereHas('child', fn ($query) => $query->where('nama', $childName))
            ->firstOrFail()
            ->forceFill([
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ])
            ->save();
    }

    private function validReportPayload(): array
    {
        return [
            'nama_posyandu' => 'Posyandu Melati',
            'kecamatan' => 'Cakung',
            'kelurahan' => 'Rawa Terate',
            'no_hp_petugas' => '081234567890',
            'ayah_nama' => 'Budi Santoso',
            'ayah_alamat' => 'Jl. Melati No. 1',
            'ayah_no_hp' => '081234567891',
            'ibu_nama' => 'Siti Aminah',
            'ibu_alamat' => 'Jl. Melati No. 1',
            'ibu_no_hp' => '081234567892',
            'child_nama' => 'Ananda Pratama',
            'child_jenis_kelamin' => 'laki-laki',
            'child_tanggal_lahir' => now()->subMonths(8)->toDateString(),
            'berat_badan' => '8.20',
            'tinggi_badan' => '71.50',
            'lingkar_kepala' => '43.00',
            'imunisasi' => 'BCG',
            'beri_vitamin_a' => '1',
            'beri_obat_cacing' => '0',
        ];
    }
}
