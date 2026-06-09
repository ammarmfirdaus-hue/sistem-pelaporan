<?php

namespace App\Services;

use App\Models\Posyandu;
use App\Models\User;

class PosyanduService
{
    public function __construct(private readonly ActivityLogService $activityLogService)
    {
    }

    public function generateKodeInternal(): string
    {
        $lastId = (int) Posyandu::query()->lockForUpdate()->max('id');

        do {
            $lastId++;
            $code = 'UT-PSY-'.str_pad((string) $lastId, 4, '0', STR_PAD_LEFT);
        } while (Posyandu::where('kode_internal', $code)->exists());

        return $code;
    }

    public function createForUser(User $user, array $data): Posyandu
    {
        $posyandu = Posyandu::create([
            'kode_internal' => $this->generateKodeInternal(),
            'kode_resmi_ut' => null,
            'nama_posyandu' => $data['nama_posyandu'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'status_verifikasi' => 'pending',
            'created_by' => $user->id,
        ]);

        $user->forceFill(['posyandu_id' => $posyandu->id])->save();
        $user->setRelation('posyandu', $posyandu);

        $this->activityLogService->record(
            'create_posyandu',
            'posyandu',
            'Petugas membuat profil posyandu pertama kali.',
            ['posyandu_id' => $posyandu->id],
            $user
        );

        return $posyandu;
    }

    public function getForUser(User $user): ?Posyandu
    {
        return $user->posyandu()->first();
    }

    public function updateIdentity(User $user, array $data): Posyandu
    {
        $posyandu = $this->getForUser($user);

        abort_if(! $posyandu, 404);

        $posyandu->update([
            'nama_posyandu' => $data['nama_posyandu'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
        ]);

        $this->activityLogService->record(
            'update_posyandu',
            'posyandu',
            'Petugas memperbarui identitas posyandu.',
            ['posyandu_id' => $posyandu->id],
            $user
        );

        return $posyandu;
    }
}
