<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('posyandu_id')->constrained('posyandus')->cascadeOnDelete();
            $table->string('nama_petugas');
            $table->string('no_hp_petugas');
            $table->date('tanggal_laporan');
            $table->timestamps();

            $table->index('user_id');
            $table->index('posyandu_id');
            $table->index('tanggal_laporan');
            $table->index('created_at');
        });

        Schema::create('parent_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['ayah', 'ibu']);
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_hp');
            $table->timestamps();

            $table->index(['report_id', 'type']);
        });

        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->timestamps();
        });

        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('lingkar_kepala', 5, 2);
            $table->string('imunisasi')->nullable();
            $table->boolean('beri_vitamin_a')->default(false);
            $table->boolean('beri_obat_cacing')->default(false);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('module');
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'action']);
            $table->index('module');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('measurements');
        Schema::dropIfExists('children');
        Schema::dropIfExists('parent_identities');
        Schema::dropIfExists('reports');
    }
};
