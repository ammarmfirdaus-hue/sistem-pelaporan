<?php

namespace App\Services;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function __construct(
        private readonly PosyanduService $posyanduService,
        private readonly ActivityLogService $activityLogService,
    ) {
    }

    public function store(User $user, array $data): Report
    {
        return DB::transaction(function () use ($user, $data) {
            $user->refresh();
            $posyandu = $user->posyandu;

            if (! $posyandu) {
                $posyandu = $this->posyanduService->createForUser($user, $data);
            }

            $report = Report::create([
                'user_id' => $user->id,
                'posyandu_id' => $posyandu->id,
                'nama_petugas' => $user->name,
                'no_hp_petugas' => $data['no_hp_petugas'],
                'tanggal_laporan' => now()->toDateString(),
            ]);

            $report->parentIdentities()->createMany([
                [
                    'type' => 'ayah',
                    'nama' => $data['ayah_nama'],
                    'alamat' => $data['ayah_alamat'],
                    'no_hp' => $data['ayah_no_hp'],
                ],
                [
                    'type' => 'ibu',
                    'nama' => $data['ibu_nama'],
                    'alamat' => $data['ibu_alamat'],
                    'no_hp' => $data['ibu_no_hp'],
                ],
            ]);

            $report->child()->create([
                'nama' => $data['child_nama'],
                'jenis_kelamin' => $data['child_jenis_kelamin'],
                'tanggal_lahir' => $data['child_tanggal_lahir'],
            ]);

            $report->measurement()->create([
                'berat_badan' => $data['berat_badan'],
                'tinggi_badan' => $data['tinggi_badan'],
                'lingkar_kepala' => $data['lingkar_kepala'],
                'imunisasi' => $data['imunisasi'] ?? null,
                'beri_vitamin_a' => (bool) ($data['beri_vitamin_a'] ?? false),
                'beri_obat_cacing' => (bool) ($data['beri_obat_cacing'] ?? false),
            ]);

            $this->activityLogService->record(
                'submit_report',
                'report',
                'Petugas menyimpan laporan bayi atau balita.',
                ['report_id' => $report->id, 'posyandu_id' => $posyandu->id],
                $user
            );

            return $report->load(['posyandu', 'father', 'mother', 'child', 'measurement']);
        });
    }
}
