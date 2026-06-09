<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posyandus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_internal')->unique();
            $table->string('kode_resmi_ut')->nullable()->unique();
            $table->string('nama_posyandu');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->enum('status_verifikasi', ['draft', 'pending', 'verified'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('kode_internal');
            $table->index('kode_resmi_ut');
            $table->index('kecamatan');
            $table->index('kelurahan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posyandus');
    }
};
