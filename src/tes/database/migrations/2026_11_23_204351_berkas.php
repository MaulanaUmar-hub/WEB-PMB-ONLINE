<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id('idberkas');
            $table->foreignId('idpendaftar')
                ->constrained('data_pendaftar', 'idpendaftar')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('jenis_berkas'); // KK, KTP, ijazah, pas foto
            $table->string('file_path');
            $table->timestamps();

            $table->unique(['idpendaftar', 'jenis_berkas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};