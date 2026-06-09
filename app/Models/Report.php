<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'posyandu_id',
        'nama_petugas',
        'no_hp_petugas',
        'tanggal_laporan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_laporan' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

    public function parentIdentities()
    {
        return $this->hasMany(ParentIdentity::class);
    }

    public function father()
    {
        return $this->hasOne(ParentIdentity::class)->where('type', 'ayah');
    }

    public function mother()
    {
        return $this->hasOne(ParentIdentity::class)->where('type', 'ibu');
    }

    public function child()
    {
        return $this->hasOne(Child::class);
    }

    public function measurement()
    {
        return $this->hasOne(Measurement::class);
    }
}
