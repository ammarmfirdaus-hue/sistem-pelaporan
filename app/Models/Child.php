<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        'report_id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function getAgeDisplayAttribute(): string
    {
        if (!$this->tanggal_lahir) {
            return '-';
        }

        $now = now()->startOfDay();
        $birth = $this->tanggal_lahir->copy()->startOfDay();

        if ($birth->isAfter($now)) {
            return '0 Hari';
        }

        $diff = $birth->diff($now);
        $totalMonths = ($diff->y * 12) + $diff->m;
        $days = $diff->d;

        if ($totalMonths === 0) {
            return $days . ' Hari';
        }

        if ($days === 0) {
            return $totalMonths . ' Bulan';
        }

        return $totalMonths . ' Bulan ' . $days . ' Hari';
    }
}
