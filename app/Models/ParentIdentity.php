<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentIdentity extends Model
{
    protected $fillable = [
        'report_id',
        'type',
        'nama',
        'alamat',
        'no_hp',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
