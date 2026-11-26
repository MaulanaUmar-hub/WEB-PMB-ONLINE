<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pendaftar', function (Blueprint $table) {
            $table->string('sumber_info')->nullable();

            // Draft belum punya program studi, jadi pilihan1 harus boleh kosong.
            // (Laravel <= 10 butuh: composer require doctrine/dbal)
            $table->string('pilihan1')->nullable()->change();
        });

        Schema::table('biodata', function (Blueprint $table) {
            $table->string('tempat_lahir', 100)->nullable();
            $table->string('nisn', 10)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('biodata', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'nisn']);
        });

        Schema::table('data_pendaftar', function (Blueprint $table) {
            $table->dropColumn('sumber_info');
        });
    }
};
