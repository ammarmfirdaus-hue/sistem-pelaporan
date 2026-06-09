<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'report_id',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'imunisasi',
        'beri_vitamin_a',
        'beri_obat_cacing',
    ];

    protected function casts(): array
    {
        return [
            'berat_badan' => 'decimal:2',
            'tinggi_badan' => 'decimal:2',
            'lingkar_kepala' => 'decimal:2',
            'beri_vitamin_a' => 'boolean',
            'beri_obat_cacing' => 'boolean',
        ];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
