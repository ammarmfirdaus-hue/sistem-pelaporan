<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $fillable = [
        'kode_internal',
        'kode_resmi_ut',
        'nama_posyandu',
        'kecamatan',
        'kelurahan',
        'status_verifikasi',
        'created_by',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
