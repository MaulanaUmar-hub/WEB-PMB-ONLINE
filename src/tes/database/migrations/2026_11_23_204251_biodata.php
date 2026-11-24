<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biodata', function (Blueprint $table) {
            // PK sekaligus FK -> 1 pendaftaran = 1 biodata
            $table->unsignedBigInteger('idpendaftar')->primary();
            $table->string('nama');
            $table->char('nik', 16)->unique();
            $table->char('no_kk', 16);
            $table->date('tanggal_lahir');
            $table->string('gender');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_wali')->nullable();
            $table->string('no_hp_wali')->nullable();
            $table->timestamps();

            $table->foreign('idpendaftar')
                ->references('idpendaftar')->on('data_pendaftar')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};