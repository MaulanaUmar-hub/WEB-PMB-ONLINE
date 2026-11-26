<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pendaftar', function (Blueprint $table) {
            // Nullable karena draft yang sudah ada belum punya kelas.
            $table->foreignId('kelas_id')
                ->nullable()
                ->constrained('kelas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('data_pendaftar', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kelas_id');
        });
    }
};
